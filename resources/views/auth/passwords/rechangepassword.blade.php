@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}}   | {{__('messages.rechangepassword')}} @endsection
@section('content')
 <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'تغيير كلمة المرور ' : 'rechange password'}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
    <div id="account-login" class="container">
          <div class="row">
          

          <div id="content" class="col-sm-9">
      {{-- <p>{{session('locale')=='ar' ? 'أدخل كلمة المرور الجديدة' : 'Enter the new password'}}</p> --}}

      <form action="{{ route('rechangepass') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" name="rechangepassword" value="{{session()->get('data')}}">
           <fieldset>
                <legend>{{session('locale')=='ar' ? 'أدخل كلمة المرور الجديدة ' : ' Enter new password'}}</legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-password">{{session('locale')=='ar' ? 'كلمة المرور الجديدة' : 'new password'}}</label>
                  <div class="col-sm-10">
                    <input type="password" name="password"  placeholder="{{session('locale')=='ar' ? 'كلمة المرور الجديدة' : 'new password'}}" id="input-password" class="form-control" required>
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
        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" value="{{session('locale')=='ar' ? 'متابعة' : 'continue'}}" class="btn btn-primary">
          </div>
        </div>
      </form>
      </div>
        
      </div>
    </div>
    </div>


@endsection