<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\member;  
use App\item; 
use App\order;
use App\order_item;
use App\rate;
use App\notification;
use App\favorite_item;
use Carbon\Carbon;
use DB;  


class adminmemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  
    {
        $mainactive = 'users';
        $subactive  = 'user';
        $logo       = DB::table('settings')->value('logo');
        $allusers   = member::orderBy('id','desc')->get();
        return view('admin.users.index',compact('mainactive','subactive','logo','allusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainactive = 'users';
        $subactive  = 'adduser';
        $logo       = DB::table('settings')->value('logo');
        return view('admin.users.create',compact('mainactive','logo','subactive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'        => 'required',
            'lastname'    => 'required',
            'phone'       => 'required|unique:members', 
            'email'       => 'required|unique:members', 
            'pass'        => 'required|min:6',  
            'confirmpass' => 'required|same:pass',
         ]);

            $newmember            = new member;
            $newmember->name      = $request['name'];
            $newmember->lastname  = $request['lastname'];
            $newmember->email     = $request['email'];
            $newmember->phone     = $request['phone'];
            
            $newmember->password  = Hash::make($request['pass']);
            $newmember->save();
            session()->flash('success','تم اضافة عضو بنجاح');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainactive        = 'users';
        $subactive         = 'user';
        $logo              = DB::table('settings')->value('logo');
        $showuser          = member::find($id);
        $myorders          = order::where('user_id',$id)->where('back',0)->orderBy('id','desc')->get();
        $returnorders      = order::where('user_id',$id)->where('back','>',0)->orderBy('id','desc')->get();
        $myfavourites      = favorite_item::where('user_id',$id)->orderBy('id','desc')->get();
        $mytotal           = 0 ;
        return view('admin.users.show',compact('mainactive','subactive','logo','showuser','myorders','myfavourites','mytotal','returnorders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainactive = 'users';
        $subactive  = 'edituser';
        $logo       = DB::table('settings')->value('logo');
        $eduser     = member::find($id);
        return view('admin.users.edit',compact('mainactive','subactive','logo','eduser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upmember = member::find($id);

        if(Input::has('suspensed'))
        {
            if($upmember->suspensed == 0)
            {
                DB::table('members')->where('id',$id)->update(['suspensed' => 1]);
                session()->flash('success','تم تعطيل عضوية العضو بنجاح');
                return back();
            }
            else 
            {
                DB::table('members')->where('id',$id)->update(['suspensed' => 0]);
                session()->flash('success','تم تفعيل عضوية العضو بنجاح');
                return back();
            }
        }
        else 
        {
            $this->validate($request,[
                'name'        => 'required',
                'lastname'        => 'required',
                'phone'       => 'required|unique:members,phone,'.$id, 
                'email'       => 'required|unique:members,email,'.$id, 
             ]);
    
                $upmember->name      = $request['name'];
                $upmember->lastname      = $request['lastname'];
                $upmember->email      = $request['email'];
                $upmember->phone     = $request['phone'];
                
                $upmember->password  = $request['pass'] ? Hash::make($request['pass']) : $upmember->password;
                $upmember->save();
            session()->flash('success','تم تعديل بيانات العضو بنجاح');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Input::has('delrate'))
        {
            rate::where('id',$id)->delete();
            return back();
        }
        else 
        {
            $deluser = member::find($id);
            if($deluser)
            {   
                favorite_item::where('user_id',$id)->delete();
                notification::where('user_id',$id)->delete();
                $myorders = order::where('user_id',$id)->get();
                foreach($myorders as $order)
                {
                    order_item::where('order_id',$order->id)->delete();
                    order::where('id',$order->id)->delete();
                }
                rate::where('user_id',$id)->delete();
                $deluser->delete();
                session()->flash('success','تم حذف العضو بنجاح');
            }
            return back();
        }    
    }

    public function deleteAll(Request $request)
    {
        $ids   = $request->ids;
        $users = DB::table("members")->whereIn('id',explode(",",$ids))->get();;
        foreach($users as $user)
        {
            favorite_item::where('user_id',$user->id)->delete();
            notification::where('user_id',$user->id)->delete();
            $myorders = order::where('user_id',$user->id)->get();
            foreach($myorders as $order)
            {
                order_item::where('order_id',$order->id)->delete();
                order::where('id',$order->id)->delete();
            }
            rate::where('user_id',$user->id)->delete();
            member::where('id',$user->id)->delete();
        }
        return response()->json(['success'=>"تم الحذف بنجاح"]);
    }
}
