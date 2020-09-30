<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\contact;
use DB;

class contactController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info  = setting::first();
        return view('front.contact.index',compact('info'));
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
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ],
        [
            'name.required'      => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'email.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'email.email'        => session('locale') == 'en' ?  'The :attribute must be a valid email address.'  : ' صيغة البريد الالكترونى غير صحيحة',
            'message.required'   => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
        ]);

        $newcontact          = new contact();
        $newcontact->name    = $request->name;
        $newcontact->email   = $request->email;
        $newcontact->message = $request->message;
        $newcontact->save();
        $successmessage = session('locale') == 'en' ? 'Message Sent Successfully' : 'تم ارسال الرسالة بنجاح';
        session()->flash('success', $successmessage);
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
