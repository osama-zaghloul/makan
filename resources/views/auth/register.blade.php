@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.register')}} @endsection
@section('content')

 <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'انشاء حساب جديد' : 'create new account'}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
      <div id="account-register" class="container">
          <div class="row">
          

            <div id="content" class="col-sm-9">
            <p>{{session('locale')=='ar' ? 'إذا كان لديك حساب معنا ، الرجاء الدخول إلى' : 'If you already have an account , please go to'}} <a href="{{asset('/login')}}">{{session('locale')=='ar' ? 'صفحة تسجيل الدخول' : 'login page'}}</a>.</p>
            
        <form  method="post" action="{{ route('register') }}" enctype="multipart/form-data" class="form-horizontal">
                
              <fieldset id="account">
                <legend> {{session('locale')=='ar' ? 'معلوماتك الشخصية' : 'personal information'}}</legend>
               
                @csrf
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-firstname">{{session('locale')=='ar' ? 'الاسم الأول' : 'first name'}}</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="{{old('name')}}"   placeholder="{{session('locale')=='ar' ? 'الاسم الأول' : 'first name'}}" id="input-firstname" class="form-control" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                    </div>
                </div>

                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-lastname">{{session('locale')=='ar' ? 'الاسم الاخير' : 'last name'}}</label>
                  <div class="col-sm-10">
                    <input type="text" name="lastname" value="{{old('lastname')}}"  placeholder="{{session('locale')=='ar' ? 'الاسم الاخير' : 'last name'}}" id="input-lastname" class="form-control" required>
                    @if ($errors->has('lastname'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('lastname') }}</strong></span>
                    @endif
                    </div>
                </div>
                <!--<div class="form-group required">-->
                <!--  <label class="col-sm-2 control-label" for="input-email">{{session('locale')=='ar' ? 'البريد الالكتروني' : 'Email'}}</label>-->
                <!--  <div class="col-sm-10">-->
                <!--    <input type="email" name="email" value="{{old('email')}}" placeholder="{{session('locale')=='ar' ? 'البريد الالكتروني' : 'Email'}}" id="input-email" class="form-control" required>-->
                <!--     @if ($errors->has('email'))-->
                <!--        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('email') }}</strong></span>-->
                <!--    @endif-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-telephone">{{session('locale')=='ar' ? 'رقم الهاتف أو الجوال' : 'phone'}}</label>
                  <div class="col-sm-10">
                    <input type="tel" name="phone" value="{{old('phone')}}" placeholder="{{session('locale')=='ar' ? 'رقم الهاتف أو الجوال' : 'phone'}}" id="input-telephone" class="form-control" required>
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                    @endif
                    </div>
                </div>
                 <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-email">{{session('locale')=='ar' ? 'المنطقة' : 'zone'}}</label>
                  <div class="col-sm-10">
                    <input type="text" name="address" value="{{old('address')}}" placeholder="{{session('locale')=='ar' ? 'المنطقة ' : 'zone'}}" id="input-address" class="form-control" required>
                     @if ($errors->has('address'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
                    @endif
                    </div>
                </div>
                
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-district">{{session('locale')=='ar' ? 'الحي' : 'district'}}</label>
                  <div class="col-sm-10">
                    <input type="text" name="district" value="{{old('district')}}" placeholder="{{session('locale')=='ar' ? ' الحي' : 'district'}}" id="input-address" class="form-control" required>
                     @if ($errors->has('district'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('district') }}</strong></span>
                    @endif
                    </div>
                </div>
                
                        </fieldset>
              <fieldset>
                <legend>{{session('locale')=='ar' ? 'كلمة المرور الخاصة بك' : 'password confirmation'}}</legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-password">{{session('locale')=='ar' ? 'كلمة المرور' : 'password'}}</label>
                  <div class="col-sm-10">
                    <input type="password" name="password"  placeholder="{{session('locale')=='ar' ? 'كلمة المرور' : 'password'}}" id="input-password" class="form-control" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                    </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-confirm">{{session('locale')=='ar' ? 'تأكيد كلمة المرور' : 'confirm password'}}</label>
                  <div class="col-sm-10">
                    <input type="password" name="confirmpass" value="" placeholder="{{session('locale')=='ar' ? 'تأكيد كلمة المرور' : 'confirm password'}}" id="input-confirm" class="form-control" required>

                    @if ($errors->has('confirmpass'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('confirmpass') }}</div>
                    @endif 
                    </div>
                </div>
              </fieldset>
              <!--<fieldset>-->
              <!--  <legend>{{session('locale')=='ar' ? 'القائمة البريدية' : 'Email list'}}</legend>-->
              <!--  <div class="form-group">-->
              <!--    <label class="col-sm-2 control-label">{{session('locale')=='ar' ? 'اشترك' : 'Subscribe'}}</label>-->
              <!--    <div class="col-sm-10">               <label class="radio-inline">-->
              <!--        <input type="radio" name="subscribe" value="1">-->
              <!--        {{session('locale')=='ar' ? 'نعم' : 'Yes'}}</label>-->
              <!--      <label class="radio-inline">-->
              <!--        <input type="radio" name="subscribe" value="0" checked="checked">-->
              <!--        {{session('locale')=='ar' ? 'لا' : 'No'}}</label>-->
              <!--      </div>-->
              <!--  </div>-->
              <!--</fieldset>-->
             

              <div class="buttons">
                <div class="">{{session('locale')=='ar' ? 'لقد قرأت ووافقت على ' : 'I have read and agree to'}}<a href="{{asset('/privacy')}}" class="agree"><b>{{session('locale')=='ar' ? 'الخصوصية' : 'privacy'}}</b></a>
                              <input type="checkbox" name="agree" value="1" required>
                              &nbsp;
                  <input type="submit" value="{{session('locale')=='ar' ? 'تسجيل جديد' : 'register'}}" class="btn btn-primary">
                </div>
              </div>
            </form>
            </div>
          
      </div>
      </div>
    </div>

@endsection