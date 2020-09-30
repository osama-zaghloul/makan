<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\member;
use App\favorite_item;
use App\item;
use App\item_image;
use App\order;
use App\order_item;
use App\setting;
use App\notification;
use App\following;
use App\ad_image;
use Carbon\Carbon;
use App\cart;
use App\transfer;
use DB;


class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // myprofil information
    public function index()
    {
        $mainactive = 'myprofile';
        $myprofile  = member::find(Auth()->user()->id);
        return view('front.profile.myprofile',compact('mainactive','myprofile'));
    }

    // myorders
    public function index2()
    {
        $mainactive        = 'myorders';
        $mytotal           = 0;
        $errormessage      = '';
        $myorders          = order::where('user_id',Auth()->user()->id)->orderBy('id','desc')->get();
        if(count($myorders) == 0)
        {
            $errormessage = session('locale') == 'en' ? 'No Orders Found' : 'لا يوجد طلبات' ;
        }
        return view('front.profile.myorders',compact('mainactive','myorders','mytotal','errormessage'));
    }

    
    // show order
    public function showorder($id)
    {
        $mainactive        = 'showorder';
        $showorder         = order::where('id',$id)->where('user_id',Auth()->user()->id)->orderBy('id','desc')->first();
        if($showorder)
        {
            $orderitems        = order_item::where('order_id',$id)->get();
        }
        else 
        {
            return redirect('myorders');
        }
        
        return view('front.profile.showorder',compact('mainactive','orderitems'));
    }


    // return order
    public function returnorder($id)
    {
        
         order::where('id',$id)->where('user_id',Auth()->user()->id)->update(['back' => 1]);
        
        
        return back();
    }

    // return orders
    public function returnorders()
    {
        $mainactive        = 'returnorder';
        $returnorders = order::where('user_id',Auth()->user()->id)->where('back',2)->get();
        
        return view('front.profile.returnorders',compact('mainactive','returnorders'));
    }


    // mycredit
    public function mycredit()
    {
        $mainactive        = 'mycredit';
        
        
        return view('front.profile.mycredit',compact('mainactive'));
    }

    // mybills
    public function index5()
    {
        $mainactive        = 'mybills';
        $mytotal           = 0;
        $errormessage      = '';
        $mybills           = order::where('user_id',Auth()->user()->id)->orderBy('id','desc')->get();
        if(count($mybills) == 0)
        {
            $errormessage = session('locale') == 'en' ? 'No Bills Found' : 'لا يوجد فواتير' ;
        }
        return view('front.profile.mybills',compact('mainactive','mybills','mytotal','errormessage'));
    }

    // myfavoriteitems
    public function index3(Request $request)
    {
        $mainactive     = 'myfavorites';
        $errormessage   = '';
        $favouriteitems = array();
        $favitems       = favorite_item::where('user_id',Auth()->user()->id)->orderBy('id','desc')->get(); 
            if(count($favitems) == 0)
            {  
              $errormessage = session('locale') == 'ar' ? 'لا يوجد منتجات ف المفضلة' : 'There are no favorite products';
            }
            else 
            {
              $lang      = session('locale') == 'ar' ? 'ar' : 'en';
              foreach($favitems as $item)
              {
                $allfavads[] = item::where('id',$item->item_id)->first();
              }
              
              foreach($allfavads as $item)
              {
                $image     = item_image::where('item_id',$item->id)->first();
                $favorited = 0;
               
                $fav = DB::table('favorite_items')->where('user_id',$request->user_id)->where('item_id',$item->id)->get();
                $favorited = count($fav) != 0 ? 1 : 0;
                
                array_push($favouriteitems, 
                array(
                    "id"              => $item->id,
                    'image'           => $image->image,
                    'title'           => $item[$lang.'title'],
                    "price"           => $item->price,
                    "offer"           => $item->offer,
                    "discountprice"   => $item->discountprice,
                    'favorited'       => $favorited,
                    ));
              }
            }
            return view('front.profile.myfavorites',compact('mainactive','favouriteitems','errormessage'));
    }

     // mynotification
    public function index4()
    {
        $mainactive         = 'mynotification';
        $errormessage       = '';
        $mynotifications    =  notification::where('user_id',Auth()->user()->id)->orderBy('id','desc')->get();
        if(count($mynotifications) != 0)
        {
            foreach ($mynotifications as $notification) 
            {
                DB::table('notifications')->where('id',$notification->id)->update(['readed' => 1]);
            }
        }
        else {
            $errormessage = session('locale') == 'en' ? 'No Notifications Found' : 'لا يوجد إشعارات' ;
        }
        return view('front.profile.mynotification',compact('mainactive','mynotifications','errormessage'));
    }
   
    // banktransfer
    public function banktransfer($id)
    {
        $billnumber = $id;
        return view('front.profile.banktransfer',compact('billnumber'));
    }
    
    // send banktransfer
    public function sendbanktransfer(Request $request , $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'phone'       => 'required',
            'image'       => 'required|image',
        ],
        [
            'name.required'         => session('locale') == 'en' ?  'The :attribute field is required.'  : ' هذا الحقل مطلوب',
            'phone.required'        => session('locale') == 'en' ?  'The :attribute field is required.'  : ' هذا الحقل مطلوب',
            'image.required'        => session('locale') == 'en' ?  'The :attribute field is required.'  : ' هذا الحقل مطلوب',
            'image.image'           => session('locale') == 'en' ?  'The :attribute must be an image.'   : 'صيغة الملف غير صحيحة',
        ]);
        $newtransfer                = new transfer();
        $newtransfer->name          = $request->name;
        $newtransfer->phone         = $request->phone;
        $newtransfer->bill_number   = $id;
        if($request->hasFile('image'))
        {
            $image    = $request['image'];
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(base_path('users/images/'),$filename);
            $newtransfer->image = $filename;
        }
        $newtransfer->save();
        DB::table('orders')->where('order_number',$id)->update(['paid' => 2]);
        $successmessage = session('locale') == 'en' ? 'Transfer Sent Successfully' : 'تم ارسال التحويل بنجاح';
        session()->flash('success', $successmessage);
        return redirect('mybills');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
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
        $updateinfo   = member::find($id);  
        $this->validate($request, [
            'name'        => 'required',
            'lastname'    => 'required',
            'phone'       => 'required|unique:members,phone,'.$updateinfo->id,
            'district'    => 'required',
            'address'    => 'required',
            
        ],
        [
            'name.required'         => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'lastname.required'         => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'phone.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'phone.unique'          => session('locale') == 'en' ?  'The :attribute has already been taken.'         : 'تم اخذ رقم الجوال سابقا',
            'district.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'address.required'         => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            
        ]);

        $updateinfo->name      = $request['name']    ;
        $updateinfo->lastname  = $request['lastname']    ;
        $updateinfo->district      = $request['district']    ;
        $updateinfo->phone     = $request['phone']   ;
         $updateinfo->address     = $request['address']   ;
        
        // if($request['pass'])
        // {
        //     $this->validate($request, [
        //         'pass'        => 'required|min:8',
        //     ],
        //     [
        //         'pass.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
        //         'pass.min'          => session('locale') == 'en' ?  'The :attribute must be at least :min.'          : ' كلمة المرور لا تقل عن 8 احرف', 
        //     ]
        // );
        // $updateinfo->password = Hash::make($request['pass']);
        // }
        // else 
        // {
        //     $updateinfo->password = $updateinfo->password;
        // }
        $updateinfo->save(); 
        $message =  session('locale') == 'ar' ?  'تم تحديث البيانات بنجاح' : ' profile has been updated successfully';
        session()->flash('success', $message);
        return back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(Input::has('delnotification'))
        // {
            notification::find($id)->delete();
            return back();
        // }
    }
}
