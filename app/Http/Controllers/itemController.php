<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\item;
use App\item_image;
use App\category;
use App\subcategory;
use DB;

class itemController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allitems  = item::where('suspensed',0)->paginate(20);
        $itemscount  = count($allitems);
        
        return view('front.items.index',compact('allitems','itemscount'));
    }

    public function filter($id)
    {

        if($id = 1)
        {
        $allitems  = item::where('suspensed',0)->where('name','desc')->get();
        $itemscount  = count($allitems);
        }
        return view('front.items.index',compact('allitems','itemscount'));
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
        $showitem     = item::findorfail($id);
        $adimages     = item_image::where('item_id',$id)->get();
        $catinfo      = category::where('id',$showitem->category_id)->first();
        $subcatinfo      = subcategory::where('id',$showitem->subcategory_id)->first();
        $similatitems = item::where('subcategory_id',$showitem->subcategory_id)->where('id','!=',$id)->get();
        return view('front.items.show',compact('showitem','adimages','catinfo','similatitems','subcatinfo'));
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
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
