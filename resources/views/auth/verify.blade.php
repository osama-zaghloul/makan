@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale')=='ar' ? 'نسيت كلمة المرور' : 'forget password'}}@endsection
@section('content')


<div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'هل نسيت كلمة المرور ؟' : '?Are you forget password'}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
    <div id="account-login" class="container">
          <div class="row">
          

          <div id="content" class="col-sm-9">
      <p>{{session('locale')=='ar' ? 'أدخل البريد الالكتروني المرتبط مع حسابك. انقر على متابعه ليتم إرسال كود إلى بريدك الخاص' : 'enter the email address that is connected to your account. Click continue to be sent a code to your private mail'}}</p>

      <form action="{{ route('send_code') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
       
        <fieldset>
          <legend>{{session('locale')=='ar' ? 'البريد الالكتروني' : 'Email'}}</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">{{session('locale')=='ar' ? 'البريد الإلكتروني' : 'Email'}}:</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="" placeholder="{{session('locale')=='ar' ? 'البريد الإلكتروني' : 'Email'}} :" id="input-email" class="form-control" required>
            </div>
             @if ($errors->has('email'))
                        <span class="invalid-feedback" style="color: crimson;font-size: 18px;" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
          </div>
          
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" value="{{session('locale')=='ar' ? 'ارسال' : 'send'}}" class="btn btn-primary">
          </div>
        </div>
      </form>
      </div>
        
      </div>
    </div>
    </div>

@endsection