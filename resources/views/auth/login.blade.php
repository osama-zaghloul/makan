@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.login')}} @endsection
@section('content')

  <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}  /</a></li>
                <li>{{session('locale')=='ar' ? 'تسجيل الدخول' : 'login'}} </li>
            </ul>
        </div>
    </div>

    <div class="pages">
    <div id="account-login" class="container">
          <div class="row">
         

        <div id="content" class="col-sm-9">
          <div class="row">
            <div class="col-sm-6">
              <div class="well">
                <h2>{{session('locale')=='ar' ? 'تسجيل جديد' : 'register'}} </h2>
                <p><strong>{{session('locale')=='ar' ? 'تسجيل حساب جديد' : 'Create new account'}} </strong></p>
                <p>{{session('locale')=='ar' ? 'لكي تقوم بإنهاء الطلب قم بإنشاء حساب جديد معنا، فهو يُمكنك من الشراء بصورة أسرع و متابعة طلبيات الشراء التي تقدمت بها, و مراجعة سجل الطلبيات القديمة واسعتراض الفواتير وغير ذلك الكثير...' : 'In order to finalize the order, create a new account with us, it enables you to buy faster and follow up on the purchase orders you have submitted, and review the old order history, invoice billing and much more ...'}} </p>

                <a href="{{ route('register') }}" class="btn btn-primary">{{session('locale')=='ar' ? 'متابعة' : 'continue'}} </a></div>
            </div>

            <div class="col-sm-6">
              <div class="well">
                <h2>{{session('locale')=='ar' ? 'تسجيل الدخول' : 'login'}} </h2>
                <p><strong>{{session('locale')=='ar' ? 'إذا كنت تملك حساب مسبق في الموقع، فتفضل بتسجيل دخولك...' : 'If you already have an account on the site, please log in ...'}} </strong></p>

                <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label class="control-label" for="input-email">{{session('locale')=='ar' ? 'رقم الجوال ' : 'phone'}} :</label>
                    <input type="text" name="phone" value="{{old('phone')}}"  placeholder="{{session('locale')=='ar' ? 'رقم الجوال' : 'phone'}}:" id="input-email" class="form-control">
                    @if ($errors->has('phone'))
                         <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                     @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="input-password">{{session('locale')=='ar' ? 'كلمة المرور' : 'password'}} :</label>
                    <input type="password" name="password" value="" placeholder="{{session('locale')=='ar' ? 'كلمة المرور' : 'password'}}:" id="input-password" class="form-control">
                    @if ($errors->has('password'))
                       <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span><br>
                     @endif

                    <a href="{{asset('/forgotpassword')}}">{{session('locale')=='ar' ? 'نسيت كلمة المرور؟' : 'forget password ?'}} </a>


                    {{-- @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">{{__('messages.forgetpass')}}</a>
                                        @endif --}}
                
                </div>
                  <input type="submit" value="{{session('locale')=='ar' ? 'دخول' : 'login'}} " class="btn btn-primary">
                              </form>
              </div>
            </div>
          </div>
          </div>
        
      </div>
    </div>
    </div>

@endsection