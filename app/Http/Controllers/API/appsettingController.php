<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use Validator;
use DB;
use App\notification;
use App\setting;
use App\contact;
use App\slider;
use App\category;
use App\item;
use App\item_image;
use App\rate;
use App\transfer;
use App\member;

class appsettingController  extends BaseController
{
    public function settingindex(Request $request)
    {
        $lang                 = $request->lang == 'ar' ? 'ar' : 'en';
        $jsonarr              = array();
        $setting              = setting::select($lang.'privacy',$lang.'about',$lang.'conditions')->get();
        $jsonarr['info']      = $setting;
        return $this->sendResponse('success', $jsonarr);
    }

    public function contactus(Request $request)
    {
        $newcontact          = new contact();
        $newcontact->name    = $request->name;
        $newcontact->phone   = $request->phone;
        $newcontact->email   = $request->email;
        $newcontact->message = $request->message;
        $newcontact->save();
        $errormessage = $request->lang == 'ar' ? 'تم ارسال الرسالة بنجاح' : 'Message Sent Successfully';
        return $this->sendResponse('success',$errormessage); 
    }

    public function categories(Request $request)
    {
        //main categories
        $allcategories = category::where('parent',0)->get();
        $maincategories         = array();
        $lang            = $request->lang == 'ar' ? 'ar' : 'en';
        foreach ($allcategories as $category) 
        {           
            array_push($maincategories, 
            array(
                    "id"      => $category->id,
                    "name"    => $category[$lang.'category'],
                    'image'   => $category->image,
                ));
        }
        return $this->sendResponse('success', $maincategories);
    }

    public function home(Request $request)
    {
        $topsliders      = array();
        $maincategories  = array();
        $bottomslider    = array();
        $lastitems       = array();
        $current         = array();
        $lang            = $request->lang == 'ar' ? 'ar' : 'en';
        
        //top sliders
        $sliders = slider::where('top',1)->where('suspensed',0)->orderBy('id','desc')->get();
        foreach ($sliders as $slider) 
            {  
                array_push($topsliders, 
                array(
                      "id"      => $slider->id,
                      'image'   => $slider->image,
                      'title'   => $slider[$lang.'title'],
                      'url'    => $slider->url,
                    ));
            }
        
        //main categories
        $groups = category::where('parent',0)->get();
            foreach ($groups as $group) 
            {           
                array_push($maincategories, 
                array(
                     "id"      => $group->id,
                     "name"    => $group[$lang.'category'],
                     'image'   => $group->image,
                    ));
            }

        //bottom sliders
        $sliders = slider::where('top',0)->where('suspensed',0)->orderBy('id','desc')->get();
        foreach ($sliders as $slider) 
            {  
                array_push($bottomslider, 
                array(
                      "id"      => $slider->id,
                      'image'   => $slider->image,
                      'title'   => $slider[$lang.'title'],
                      'url'    => $slider->url,
                    ));
            }

        //last items
        $items = item::where('suspensed',0)->orderBy('id','desc')->get();
        foreach ($items as $item) 
            {  
                $image     = item_image::where('item_id',$item->id)->first();
                $favorited = 0;
                $sumrates  = 0;
                $adrates   = rate::where('item_id',$item->id)->get();
                foreach($adrates as $value)
                {
                   $sumrates+= $value->rate;
                }
                $fullrate = $sumrates != 0 ? $sumrates/count($adrates) : 0; 
               
                if($request->user_id)
                {
                    $fav = DB::table('favorite_items')->where('user_id',$request->user_id)->where('item_id',$item->id)->get();
                    $favorited = count($fav) != 0 ? 1 : 0;
                }
                array_push($lastitems, 
                array(
                      "id"            => $item->id,
                      'image'         => $image,
                      'title'         => $item[$lang.'title'],
                      'offer'         => $item->offer,
                      'discountprice' => $item->discountprice != null ? $item->discountprice :0 ,
                      'rate'          => $fullrate,
                      'favorited'     => $favorited,
                    ));
            }
            
            $current['topsliders']     = $topsliders;        
            $current['maincategories'] = $maincategories;
            $current['bottomslider']   = $bottomslider; 
            $current['lastitems']      = $lastitems;
            return $this->sendResponse('success', $current);
    }
    
    public function addtransfer(Request $request)
    {
        $newtransfer                = new transfer();
        $newtransfer->name          = $request->name;
        $newtransfer->phone         = $request->phone;
        $info=  DB::table('orders')->where('order_number',$request->bill_number)->first();
        
        if($info){
        $newtransfer->bill_number   = $request->bill_number;
        }
        if($request->hasFile('image'))
        {
            $image    = $request['image'];
            $filename = rand(0,999999999).'.'.$image->getClientOriginalExtension();
            $image->move(base_path('users/images/'),$filename);
            $newtransfer->image = $filename;
        }
        $newtransfer->save();
        
            $notification                = new notification();
            $notification->user_id       = $request->user_id;
            $notification->notification  = 'تم إنشاء طلب جديد';
            $notification->save();
            
            // $usertoken = member::where('id',$request->user_id)->where('firebase_token','!=',null)->where('firebase_token','!=',0)->value('firebase_token');
            // if($usertoken)
            // {
            //     $optionBuilder = new OptionsBuilder();
            //     $optionBuilder->setTimeToLive(60*20);
              
            //     $notificationBuilder = new PayloadNotificationBuilder('إنشاء طلب جديد');
            //     $notificationBuilder->setBody($request->notification)
            //                         ->setSound('default');
              
            //     $dataBuilder = new PayloadDataBuilder();
            //     $dataBuilder->addData(['a_type' => 'message']);
            //     $option       = $optionBuilder->build();
            //     $notification = $notificationBuilder->build();
            //     $data         = $dataBuilder->build();
            //     $token        = $usertoken ;
              
            //     $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
              
            //     $downstreamResponse->numberSuccess();
            //     $downstreamResponse->numberFailure();
            //     $downstreamResponse->numberModification();            
            //     $downstreamResponse->tokensToDelete();
            //     $downstreamResponse->tokensToModify();
            //     $downstreamResponse->tokensToRetry();
            // }
        $errormessage = $request->lang == 'ar' ? 'تم ارسال التحويل بنجاح' : 'Transfer Sent Successfully';
        return $this->sendResponse('success',$errormessage); 
    }
}
