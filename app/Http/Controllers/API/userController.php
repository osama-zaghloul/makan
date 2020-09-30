<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\member;
use App\order;
use App\item;
use App\item_image;
use App\rate;
use App\notification;
use App\favorite_item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use DB;

class userController extends BaseController
{
    //registeration process 
    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'name'           => 'required',
                'phone'          => 'required|unique:members', 
                'address'        => 'required',
                'password'       => 'required|min:6',  
            ],
            [
                'name.required'         => $request->lang == 'ar' ? 'هذا الحقل مطلوب'              : 'The :attribute field is required.',
                'phone.required'        => $request->lang == 'ar' ? 'هذا الحقل مطلوب'              : 'The :attribute field is required.',
                'phone.unique'          => $request->lang == 'ar' ?  'تم اخذ رقم الجوال سابقا'     : 'The :attribute has already been taken.',
                'address.required'      => $request->lang == 'ar' ?  'هذا الحقل مطلوب'              : 'The :attribute field is required.',
                'password.required'     => $request->lang == 'ar' ?  'هذا الحقل مطلوب'              : 'The :attribute field is required.',
                'password.min'          => $request->lang == 'ar' ?  'كلمة المرور لا تقل عن 6 احرف' : 'The :attribute must be at least :min.', 
            ]
        );
       
        if($validator->fails())
        {
            return $this->sendError('success', $validator->errors());       
        }

        $newmember                 = new member;
        $newmember->name           = $request['name'];
        $newmember->phone          = $request['phone'];
        $newmember->address        = $request['address'];
        $newmember->password       = Hash::make($request['password']);
        $newmember->firebase_token = $request['firebase_token'];  
        $randomregcode             = substr(str_shuffle("0123456789"), 0, 6);
        $newmember->registercode   = $randomregcode; 
        $newmember->save();
        
        //set POST variables
            $url = 'https://www.hisms.ws/api.php/send_sms';
            $fields_string = '';
            $fields = array(
            	'username' => urlencode('966581120564'),
            	'password' => urlencode('hooda2009'),
            	'numbers'  => urlencode($request->phone),
            	'sender'   => urlencode('Five Stars'),
            	'message'  => urlencode($randomregcode),
            	'send_sms' => urlencode(''),
            );
            
            //url-ify the data for the POST
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');
            
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            
            //execute post
            $result = curl_exec($ch);
            
            //close connection
            curl_close($ch);
            
        $reguser = member::find($newmember->id);
        return $this->sendResponse('success', $reguser);
    }

     // Activate Account 
     
     public function activat_account(Request $request)
     {
        $userinfo = member::where('id',$request->user_id)->first();
        if($userinfo->registercode == $request->activatcode)
            {
                $userinfo->activate = 1;
                $userinfo->save();
                
                $notification                = new notification();
                $notification->user_id       = $userinfo->id;
                $notification->notification  = 'تم تسجيل حسابك بنجاح';
                $notification->save();
                return $this->sendResponse('success', $userinfo);
            }
            else
            {
                $errormessage = $request->lang == 'ar' ? 'كود التفعيل غير صحيح' : 'Activate Code Not Correct';
                return $this->sendError('success', $errormessage);
            }
     }
     
     
    //Login process
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'          => 'required',
            'password'       => 'required',
        ]);

        if($validator->fails())
        {
            return $this->sendError('success', $validator->errors());
        }

        if(Auth::attempt(['phone' => $request->phone , 'password' => $request->password , 'suspensed' => 0 ])) 
        {
            $user  = Auth::user();
            if(Auth::user()->activate == 1)
            {
                $user->firebase_token = $request->firebase_token;
                $user->save();
            }
            elseif(Auth::user()->activate == 0)
            {
                    $randomregcode        = substr(str_shuffle("0123456789"), 0, 6);
                    $user->registercode   = $randomregcode; 
                    $user->save();
                    
                    
                    //set POST variables
                    $url = 'https://www.hisms.ws/api.php/send_sms';
                    $fields_string = '';
                    $fields = array(
                    	'username' => urlencode('966581120564'),
                    	'password' => urlencode('hooda2009'),
                    	'numbers'  => urlencode($user->phone),
                    	'sender'   => urlencode('Five Stars'),
                    	'message'  => urlencode($randomregcode),
                    	'send_sms' => urlencode(''),
                    );
                    
                    //url-ify the data for the POST
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    rtrim($fields_string, '&');
                    
                    //open connection
                    $ch = curl_init();
                    
                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST, count($fields));
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    
                    //execute post
                    $result = curl_exec($ch);
                    
                    //close connection
                    curl_close($ch);
            }
            return $this->sendResponse('success', $user);  

        }
        else
        {
            $errormessage = $request->lang == 'ar' ? 'رقم الجوال او كلمة المرور غير صحيحة' : 'Phone Or Password Incorrect';
            return $this->sendError('success', $errormessage);
        }
    }

    //forgetpassword process
    public function forgetpassword(Request $request)
    {
        $user = member::where('phone',$request->phone)->first();
        if(!$user)
        {
            $errormessage = $request->lang == 'ar' ? 'رقم الجوال غير صحيح' : 'Invalid Phone number';
            return $this->sendError('success', $errormessage);
        }
        else
        {
            $randomcode        = substr(str_shuffle("0123456789"), 0, 6);
            $user->forgetcode  = $randomcode;
            $user->save();
            
            //set POST variables
            $url = 'https://www.hisms.ws/api.php/send_sms';
            $fields_string = '';
            $fields = array(
            	'username' => urlencode('966581120564'),
            	'password' => urlencode('hooda2009'),
            	'numbers'  => urlencode($request->phone),
            	'sender'   => urlencode('Hi-Active'),
            	'message'  => urlencode($randomcode),
            	'send_sms' => urlencode(''),
            );
            
            //url-ify the data for the POST
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');
            
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            
            //execute post
            $result = curl_exec($ch);
            
            //close connection
            curl_close($ch);
            
            return $this->sendResponse('success',$randomcode);
        } 
    }

    public function activcode(Request $request)
    {
      $user = member::where('phone',$request->phone)->where('forgetcode',$request->forgetcode)->first();
      if($user)
      {
        return $this->sendResponse('success','true');
      }
      else 
      {
        $errormessage = $request->lang == 'ar' ? ' الكود غير صحيح' : 'Invalid Code';
        return $this->sendError('success',$errormessage);
      }
    }
    
        //rechangepassword process
    public function rechangepass(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
          'new_password'    => 'required',
        ]);
           
      if($validator->fails())
        {
            return $this->sendError('success', $validator->errors());       
        }

        $user = member::where('phone',$request->phone)->first();
        if($user)
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $errormessage = $request->lang == 'ar' ? 'تم تغيير كلمة المرور بنجاح':'password changed successfully';
            return $this->sendResponse('success',$errormessage);
        }
        else 
        {
            $errormessage = $request->lang == 'ar' ? 'رقم الجوال غير صحيح' : 'Invalid Phone Number';
            return $this->sendError('success', $errormessage);
        }
     
    }

    //profile process
    public function profile(Request $request)
    {
        $user = member::where('id',$request->user_id)->where('suspensed',0)->first();
        if(!$user)
        { 
            $errormessage = $request->lang == 'ar' ? 'هذا المستخدم غير موجود' : 'user not Found';
            return $this->sendError('success', $errormessage);
        }
        else
        {
            return $this->sendResponse('success', $user);
        } 
    }

    //updating profile process
    public function update(Request $request)
    {
       $upuser = member::where('id',$request->user_id)->first();
        if($upuser)
        {
                $validator = Validator::make($request->all(), [
                    'name'        => 'required',
                    'phone'       => 'required|unique:members,phone,'.$upuser->id,
                    'address'     => 'required',
                ]);
                
                if($validator->fails())
                {
                    return $this->sendError('success', $validator->errors());       
                }

                $upuser->name      = $request['name']    ;
                $upuser->phone     = $request['phone']   ;
                $upuser->address   = $request['address'] ;
                $upuser->password  = $request['pass'] ? Hash::make($request['pass']) : $upuser->password;
                $upuser->save();
                return $this->sendResponse('success', $upuser);
            }
          else
          {    
            $errormessage = $request->lang == 'ar' ? 'هذا المستخدم غير موجود' : 'user not Found';
            return $this->sendError('success', $errormessage);
          }
    }

    public function mynotification(Request $request)
    {
        DB::table('notifications')->where('user_id', $request->user_id)->update(['readed' => 1]);
        $mynotifs = notification::where('user_id',$request->user_id)->orderBy('id','desc')->get();
        if(count($mynotifs) != 0)
        {
            return $this->sendResponse('success', $mynotifs);
        }
        else 
        {
            $errormessage = $request->lang == 'ar' ? 'لا يوجد تنبيهات' : 'There are no Notifications';
            return $this->sendError('success', $errormessage);
        }
    }

    public function myfavoriteitems(Request $request)
    {
        $favitems  = favorite_item::where('user_id',$request->user_id)->orderBy('id','desc')->get(); 
            if(count($favitems) == 0)
            {  
              $errormessage = $request->lang == 'ar' ? 'لا يوجد منتجات ف المفضلة' : 'There are no favorite products';
              return $this->sendError('success', $errormessage);
            }
            else 
            {
              $lang      = $request->lang == 'ar' ? 'ar' : 'en';
              foreach($favitems as $item)
              {
                $allfavads[] = item::where('id',$item->item_id)->first();
              }
              
              $currentitems = array();
              foreach($allfavads as $item)
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
               
                $fav = DB::table('favorite_items')->where('user_id',$request->user_id)->where('item_id',$item->id)->get();
                $favorited = count($fav) != 0 ? 1 : 0;
                
                array_push($currentitems, 
                array(
                    "id"              => $item->id,
                    'image'           => $image,
                    'title'           => $item[$lang.'title'],
                    "price"           => $item->price,
                    "offer"           => $item->offer,
                    "discountprice"   => $item->discountprice,
                    'rate'            => $fullrate,
                    'favorited'       => $favorited,
                    ));
              }
              return $this->sendResponse('success', $currentitems);

            return $this->sendResponse('success', $allfavads);
            }
    }
    
    public function updatefirebasebyid(Request $request)
    { 
       $user = member::where('id',$request->user_id)->first();
        if($user)
        {
            $user->firebase_token = $request->firebase_token;
            $user->save();
            $errormessage = $request->lang == 'ar' ? 'تم التحديث' : 'Token Updated';
            return $this->sendResponse('success',$errormessage);  
        }
        else
        {
            $errormessage = $request->lang == 'ar' ? 'هذا المستخدم غير موجود' : 'user not Found';
            return $this->sendError('success', $errormessage);
        }
    }
    
}
