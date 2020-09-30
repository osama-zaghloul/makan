<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\setting;
use App\member;
use App\notification;
use DB;

class adminchangelogoController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive = "setting";
        $subactive  = "changelogo";
        $logo       = DB::table('settings')->value('logo');
        $changelogo = setting::first();
        return view('admin.setting.changelogo',compact('changelogo','mainactive','logo','subactive'));
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
        // $alltokens = member::where('firebase_token','!=',null)->where('firebase_token','!=',0)->get();
        // if(count($alltokens) != 0)
        // {
        //     foreach($alltokens as $usertoken)
        //     {
        //         $notification                = new notification();
        //         $notification->user_id       = $usertoken->id;
        //         $notification->notification  = $request->notification;
        //         $notification->save();

        //         $optionBuilder = new OptionsBuilder();
        //         $optionBuilder->setTimeToLive(60*20);
            
        //         $notificationBuilder = new PayloadNotificationBuilder('تطبيق المستلزمات الفندقية');
        //         $notificationBuilder->setBody($request->notification)
        //                             ->setSound('default');
            
        //         $dataBuilder = new PayloadDataBuilder();
        //         $dataBuilder->addData(['a_type' => 'message']);
        //         $option       = $optionBuilder->build();
        //         $notification = $notificationBuilder->build();
        //         $data         = $dataBuilder->build();
        //         $token        = $usertoken->firebase_token ;
            
        //         $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            
        //         $downstreamResponse->numberSuccess();
        //         $downstreamResponse->numberFailure();
        //         $downstreamResponse->numberModification();            
        //         $downstreamResponse->tokensToDelete();
        //         $downstreamResponse->tokensToModify();
        //         $downstreamResponse->tokensToRetry();
        //     }
        //     session()->flash('success','تم ارسال الاشعارات بنجاح');
        // }
        // return back();

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
       
        $upinfo = setting::find($id);
        // if(Input::has('updatesocial'))
        // {
        //     $upinfo->snapchat      = $request->snapchat;
        //     $upinfo->twitter       = $request->twitter;
        //     $upinfo->instagram     = $request->instagram;
        //     $upinfo->telegram      = $request->telegram;
        //     $upinfo->youtube       = $request->youtube;
        //     $upinfo->googleplay	   = $request->googleplay;
        //     $upinfo->applestore    = $request->applestore;
        //     $upinfo->save();
        //     session()->flash('success','تم تعديل مواقع التواصل بنجاح');
        //     return back();
        // }
        // else 
        // {
            $this->validate($request,[
                'logo'       =>'image',
                'tax'       =>'required',
                'shipping'       =>'required',
                'shipping_item'       =>'required',
                
            ]);

            $upinfo->phone         = $request->phone;
            $upinfo->whatsapp      = $request->whatsapp;
            $upinfo->email         = $request->email;
            $upinfo->tax         = $request->tax;
            $upinfo->shipping         = $request->shipping;
            $upinfo->shipping_item  = $request->shipping_item;

            if($request->hasFile('logo'))
            {
                $image    = $request['logo'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(base_path('users/images/'),$filename);
                $upinfo->logo = $filename;
            }

            $upinfo->save();
            session()->flash('success','تم تعديل البيانات بنجاح');
            return back();
        // }
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
