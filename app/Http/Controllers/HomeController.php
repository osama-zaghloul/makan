<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use Session;
use App\slider;
use App\item;
use App\setting;
use App\category;
use App\subscriped_email;
use App\member;
use App\notification;
use App\favorite_item;

class HomeController extends Controller
{  
    public function index()
    {
        // session::put('locale','ar');
        $allsliders    = slider::where('suspensed',0)->get();
        $slideritems   = item::where('suspensed',0)->orderBy('id','desc')->limit(2)->get();
        $lastitems     = item::where('suspensed',0)->orderBy('id','desc')->limit(10)->get();
        $items         = item::where('suspensed',0)->orderBy('id','asc')->limit(8)->get();
        $allcategories = category::all();
        return view('front.home',compact('allsliders','slideritems','lastitems','allcategories','items'));
    }

    public function mostsold()
    {
        $items = item::where('suspensed',0)->orderBy('id','asc')->limit(10)->get();
        $itemscount=count($items);
        return view('front.mostsold.index',compact('items','itemscount'));
    }
    
    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'email'=>'email|required',
    //     ],
    //     [
    //         'email.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
    //         'email.email'        => session('locale') == 'en' ?  'The :attribute must be a valid email address.'  : ' صيغة البريد الالكترونى خاطئة',
    //     ]);

    //     $newsubscriped_email = new subscriped_email;
    //     $newsubscriped_email->email = $request->email;
    //     $newsubscriped_email->created_at = now();
    //     $newsubscriped_email->save();
    //     session()->flash('success',__('messages.successsubscribeemail') );
    //     return back();
    // }

      //register
    public function register(Request $request)
    {
       $this->validate($request,[
            'name'     => ['required', 'string', 'max:255'],
            'lastname'     => ['required', 'string', 'max:255'],
            'phone'    => ['required','digits_between:10,20', 'unique:members'],
            'address'    => ['required'],
            'district'    => ['required'],
            'password' => ['required', 'string', 'min:8'],
            'confirmpass' => ['required', 'same:password'],
        ],
        [
            'name.required'         => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'lastname.required'         => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'phone.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'phone.unique'          => session('locale') == 'en' ?  'The :attribute has already been taken.'         : 'تم اخذ رقم الجوال سابقا',
            'address.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
             'district.required'        => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'password.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
            'password.min'          => session('locale') == 'en' ?  'The :attribute must be at least :min.'          : ' كلمة المرور لا تقل عن 8 احرف', 
            'confirmpass'    => session('locale') == 'en' ?  'The :attribute confirmation does not match.'    : 'كلمة المرور غير متطابقة', 
        ]
    );

    //  $randomregcode  = substr(str_shuffle("0123456789"), 0, 6);
            $newmember              = new member();
            $newmember->name         = $request['name'];
            $newmember->lastname     = $request['lastname'];
            $newmember->phone        = $request['phone'];
             $newmember->address     = $request['address'];
              $newmember->district     = $request['district'];
            // 'registercode' => $randomregcode,
            $newmember->password  = Hash::make($request['password']);
            $newmember->save();

        // if($request->subscribe == 1)
        // {
        //     $newsubscriped_email = new subscriped_email();
        //     $newsubscriped_email->email = $request['email'];
        //     $newsubscriped_email->created_at = now();
        //     $newsubscriped_email->save();
        // }

            $notification                = new notification();
            $notification->user_id       = $newmember->id;
            $notification->notification  = session('locale')=='ar' ? 'تم تسجيل حسابك بنجاح' : 'you have registerd successfully';
            $notification->save();

        
       $message = session()->flash('success', session('locale')=='ar' ? 'تم تسجيل حسابك بنجاح' : 'you have registerd successfully' );
        return redirect('/login')->with($message);

    }

     // login
    public function login(Request $request)
    {
        $this->validate($request,[
            'phone'          => 'required',
            'password'       => 'required',
        ],[
            'phone.required' => session('locale') == 'en' ?  'The :attribute field is required.': ' هذا الحقل مطلوب',
        ]);
        

     
        if(Auth::attempt(['phone' => $request->phone , 'password' => $request->password , 'suspensed' => 0 ])) 
        {
            $user                 = Auth::user();
            
            
        }
      
        $allsliders= slider::where('suspensed',0)->get();
        $allcategories = category::all();
         return view('front.home',compact('allsliders','allcategories','user'));
    }


    // Account Activation
    // public function account_activation()
    // {
    //     $mainactive = 'ِactivation';
    //     return view('auth.activation',compact('mainactive'));
    //      return view('home',compact('mainactive'));
    //     $allsliders= slider::where('suspensed',0)->get();
    //     $allcategories = category::all();
    //      return view('front.home',compact('allsliders','allcategories'));


    // }

    // Activate Account 
    // public function activat_account(Request $request)
    // {
    //     $userinfo = member::where('id',session('userID'))->first();
    //     if($userinfo->registercode == $request->code)
    //     {
    //         $userinfo->activate = 1;
    //         $userinfo->save();
            
    //         $notification                = new notification();
    //         $notification->user_id       = $userinfo->id;
    //         $notification->notification  = 'تم تسجيل حسابك بنجاح';
    //         $notification->save();
    //         $successmessage = session('locale') == 'en' ? 'Your account has been successfully registered' : 'تم تسجيل حسابك بنجاح';
    //         session()->flash('success', $successmessage);
    //         Auth::login($userinfo);
    //         return redirect('/');
    //     }
    //     else
    //     {
    //         $errormessage = session('locale') == 'en' ? 'Activate Code Not Correct' :'كود التفعيل غير صحيح' ;
    //         session()->flash('error', $errormessage);
    //         return back();
    //     }
    // }

    

    public function forgotpassword(Request $request)
    {
         return view('auth.verify');
    }

public function forgotpass(Request $request)
    {
       
            $user = member::where('email',$request->email)->first();
            if(!$user)
            {
                $errormessage = session('locale') == 'en' ? 'Invalid email ' : 'الإيميل غير صحيح';
                session()->flash('error', $errormessage);
                return back();
            }
            else
            {
                $randomcode        = substr(str_shuffle("0123456789"), 0, 6);
                $user->forgetcode  = $randomcode;
                $user->save();

                // $to      = $user->email;
                // $subject = session('locale') == 'en' ? ' activation code ' : 'كود التفعيل';
                // $txt     = session('locale') == 'en' ? ' activation code is :  '.$randomcode : 'كودالتفعيل هو  :'.$randomcode;
                // $headers = "From: makan@eltamiuz.net";
                // mail($to,$subject,$txt,$headers);
                
              

                $successmessage = session('locale') == 'en' ? 'Code Sent Successfully' : 'تم إرسال الكود بنجاح';
                session()->flash('success', $successmessage);      
                return redirect('/activation')->with( ['data' => $user->email] );    
            } 

    }
    // Activation Code
    public function activation()
    {
        $mainactive = 'ِactivation';
        return view('auth.passwords.activation',compact('mainactive'));
    }


    public function activation_code(Request $request)
    {
        if($request->activecode == null)
           {
                return redirect('/forgotpassword');
           }

            $user = member::where('email',$request->activecode)->where('forgetcode',$request->code)->first();
            if($user)
            {
                return redirect('/rechangepassword')->with( ['data' => $user->email] ); 
            }
            else 
            {
                $errormessage = session('locale') == 'en' ? 'Invalid Code' : 'الكود غير صحيح';
                session()->flash('error', $errormessage);
                return back();
            }
    }

    // Rechange Password
    public function rechangepassword()
    {
        $mainactive = 'rechangepassword';
        return view('auth.passwords.rechangepassword',compact('mainactive'));
    }

     public function rechangepass(Request $request)
    {
        $this->validate($request,[
                'password' => ['required', 'min:8'],
                'confirmpass' => ['required', 'same:password'],
            ],
            [
                'password.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
                'password.min'          => session('locale') == 'en' ?  'The :attribute must be at least :min.'          : ' كلمة المرور لا تقل عن 6 احرف', 
                'confirmpass'    => session('locale') == 'en' ?  'The :attribute confirmation does not match.'    : 'كلمة المرور غير متطابقة', 
            ]);

            $user = member::where('email',$request->rechangepassword)->first();
            if($user)
            {
                $user->password = Hash::make($request->password);
                $user->save();
                $successmessage = session('locale') == 'en' ? 'password changed successfully' : 'تم تغيير كلمة المرور بنجاح';
                session()->flash('success', $successmessage);
                Auth::login($user);
                return redirect('/');
            }
            else 
            {
                return redirect('/forgotpassword');
            }
    }

    // public function forgotpasswordd(Request $request)
    // {
    //    if(Input::has('forgotpassword'))
    //    {
    //        $user = member::where('email',$request->email)->first();
    //         if(!$user)
    //         {
    //             $errormessage = session('locale') == 'en' ? 'Invalid email ' : 'الإيميل غير صحيح';
    //             session()->flash('error', $errormessage);
    //             return back();
    //         }
    //         else
    //         {
    //             $randomcode        = substr(str_shuffle("0123456789"), 0, 6);
    //             $user->forgetcode  = $randomcode;
    //             $user->save();

    //             $to      = $user->email;
    //             $subject = session('locale') == 'en' ? ' activation code ' : 'كود التفعيل';
    //             $txt     = session('locale') == 'en' ? ' activation code is :  '.$randomcode : 'كودالتفعيل هو  :'.$randomcode;
    //             $headers = "From: makan@eltamiuz.net";
    //             mail($to,$subject,$txt,$headers);
                
              

    //             $successmessage = session('locale') == 'en' ? 'Code Sent Successfully' : 'تم إرسال الكود بنجاح';
    //             session()->flash('success', $successmessage);      
    //             return redirect('/activation')->with( ['data' => $user->email] );    
    //         } 
    //    }

    //    if(Input::has('activecode'))
    //    {
    //        if($request->activecode == null)
    //        {
    //             return redirect('/password/reset');
    //        }

    //         $user = member::where('phone',$request->activecode)->where('forgetcode',$request->code)->first();
    //         if($user)
    //         {
    //             return redirect('/rechangepassword')->with( ['data' => $user->phone] ); 
    //         }
    //         else 
    //         {
    //             $errormessage = session('locale') == 'en' ? 'Invalid Code' : 'الكود غير صحيح';
    //             session()->flash('error', $errormessage);
    //             return back();
    //         }
    //    }

    //    if(Input::has('rechangepassword'))
    //    {
    //         $this->validate($request,[
    //             'password' => ['required', 'min:8', 'confirmed'],
    //             'confirmpass' => ['required', 'same:password'],
    //         ],
    //         [
    //             'password.required'     => session('locale') == 'en' ?  'The :attribute field is required.'              : ' هذا الحقل مطلوب',
    //             'password.min'          => session('locale') == 'en' ?  'The :attribute must be at least :min.'          : ' كلمة المرور لا تقل عن 6 احرف', 
    //             'confirmpass'    => session('locale') == 'en' ?  'The :attribute confirmation does not match.'    : 'كلمة المرور غير متطابقة', 
    //         ]);

    //         $user = member::where('email',$request->rechangepassword)->first();
    //         if($user)
    //         {
    //             $user->password = Hash::make($request->password);
    //             $user->save();
    //             $successmessage = session('locale') == 'en' ? 'password changed successfully' : 'تم تغيير كلمة المرور بنجاح';
    //             session()->flash('success', $successmessage);
    //             Auth::login($user);
    //             return redirect('/');
    //         }
    //         else 
    //         {
    //             return redirect('/password/reset');
    //         }
    //    }

    // }

    // aboutus 
    public function aboutus()
    {
        $lang   = session('locale') == 'en' ? 'en' : 'ar';
        $about  = setting::first();
        return view('front.aboutus.aboutus',compact('lang','about'));
    }

    // privacy 
    public function privacy()
    {
        $lang   = session('locale') == 'en' ? 'en' : 'ar';
        $privacy  = setting::first();
        return view('front.aboutus.privacy',compact('lang','privacy'));
    }

    // policy 
    public function policy()
    {
        $lang   = session('locale') == 'en' ? 'en' : 'ar';
        $policy  = setting::first();
        return view('front.aboutus.policy',compact('lang','policy'));
    }

     // shipping 
    public function shipping()
    {
        $lang   = session('locale') == 'en' ? 'en' : 'ar';
        $shipping  = setting::first();
        return view('front.aboutus.shipping',compact('lang','shipping'));
    }
    
   // bankaccounts
    public function bankaccounts()
    {
        return view('front.bankaccounts.index');
    }
    
    // addtowishlist
    public function addtowishlist(Request $request)
    {
        $favorited = favorite_item::where('item_id',$request->item_id)->where('user_id',$request->user_id)->first();
        if($favorited)
        {
            $data['count']   = favorite_item::where('user_id',$request->user_id)->count();
            $data['message'] = session('locale') == 'en' ? 'This product is already in my favorites' : 'هذا المنتج موجود ف المفضلة';
            return response()->json($data);
        }
        else 
        {
            $newfavad = new favorite_item;
            $newfavad->user_id   = Auth()->user()->id;
            $newfavad->item_id   = $request->item_id;
            $newfavad->save();
            $data['count']    = favorite_item::where('user_id',$request->user_id)->count();
            $data['message']      = session('locale') == 'en' ? 'The favorite product has been successfully added' : ' تم اضافة المنتج ف المفضلة بنجاح';
            return response()->json($data);
        }
    }

    // remove from wishlist
    public function removefromwishlist($id)
    {
        favorite_item::where('user_id',Auth()->user()->id )->where('item_id',$id)->delete();
        $successmessage = session('locale') == 'en' ? 'The product has been Removed from favorites' : 'تم حذف المنتج من المفضلة ';
        session()->flash('success', $successmessage);
        return back();
    }

}
