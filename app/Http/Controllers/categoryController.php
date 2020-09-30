<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\item;
use App\item_image;
use App\category;
use App\subcategory;
use DB;

class categoryController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories  = category::where('parent',0)->get();
        return view('front.category.index',compact('categories'));
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
        $showcategory  = category::findorfail($id);
        $categoryitems = item::where('category_id',$id)->paginate(20);
        $subcategories = subcategory::where('category_id',$id)->get();
        $itemscount = count($categoryitems);
        return view('front.category.show',compact('showcategory','categoryitems','subcategories','itemscount'));
    }

    public function show1($id)
    {
        $subcategory  = subcategory::where('id',$id)->first();
        $showcategory  = category::where('id',$subcategory->category_id)->first();
        $subcategoryitems = item::where('subcategory_id',$id)->paginate(20);
        $itemscount = count($subcategoryitems);
        return view('front.category.showsub',compact('showcategory','subcategory','subcategoryitems','itemscount'));
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
