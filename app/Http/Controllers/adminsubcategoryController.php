<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use DB;    
use Carbon\Carbon;
use App\category;
use App\subcategory;

class adminsubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()   
    {
        $mainactive      = 'categories';
        $subactive       = 'subcategory';
        $logo            = DB::table('settings')->value('logo');
        $allsubcategories   = subcategory::all();
        $categories = category::all();
        return view('admin.subcategories.index',compact('mainactive','subactive','logo','allsubcategories','categories'));
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
        $this->validate($request,[
            'arcategory'   => 'required',
            'encategory'   => 'required',
            'maincategory'  => 'required',
         ]);

        $newsubcategory              = new subcategory;
        $newsubcategory->artitle  = $request['arcategory'];
        $newsubcategory->entitle  = $request['encategory'];
        $newsubcategory->category_id  = $request['maincategory'];
        
        $newsubcategory->save();
        session()->flash('success','تم اضافة قسم فرعي جديد');
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
        $upsubcategory = subcategory::find($id);
        $this->validate($request,[
            'arcategory'   => 'required',
            'encategory'   => 'required',
            'maincategory'   => 'required',
         ]);

        $upsubcategory->artitle     = $request['arcategory'];
        $upsubcategory->entitle     = $request['encategory'];
        $upsubcategory->category_id = $request['maincategory'];
        
        $upsubcategory->save();
        session()->flash('success','تم تعديل القسم بنجاح');
        return back();
    }

    public static function delete_parent($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delsubcategory = subcategory::find($id);
        if($delsubcategory)
        {
            $delsubcategory->delete();
            session()->flash('success','تم حذف القسم بنجاح');
        }
        return back();   
    }

    public function deleteAll(Request $request)
    {
        $ids    = $request->ids;
        $categories = DB::table("subcategories")->whereIn('id',explode(",",$ids))->get();
        foreach($subcategories as $subcategory)
        {
            $subcategory->delete();
        }
        return response()->json(['success'=>"تم الحذف بنجاح"]);
    }
}
