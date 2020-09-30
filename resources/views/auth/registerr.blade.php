@extends('front.include.master')
@section('title') {{__('messages.hsc')}} | {{__('messages.register')}} @endsection
@section('content')
<div class="clearfix"></div>

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.register')}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
      <div id="account-register" class="container">
          <div class="row">
            <div id="content" class="col-sm-9">
            <p>{{__('messages.haveaccount2')}} <a href="{{ route('login') }}">{{__('messages.login')}}</a>.</p>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                    <fieldset id="account">
                        <legend>{{__('messages.personalinfo')}}</legend>
            
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-firstname">{{__('messages.username')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="text" name="name" value="{{old('name')}}" placeholder="{{__('messages.username')}}" id="input-firstname" class="form-control" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-telephone">{{__('messages.phone')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="tel" name="phone"  value="{{old('phone')}}" placeholder="{{__('messages.phone')}}" id="input-telephone" class="form-control" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-telephone">{{__('messages.address')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="text" name="address" value="{{old('address')}}"  placeholder="{{__('messages.address')}}" id="input-telephone" class="form-control" required>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend> {{__('messages.personalpassword')}}</legend>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-password">{{__('messages.password')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="password" name="password" placeholder="{{__('messages.password')}}" id="input-password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-confirm">{{__('messages.confirmpass')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="password" name="password_confirmation" placeholder="{{__('messages.confirmpass')}}" id="input-confirm" class="form-control" required>
                            </div>
                        </div>
                        
                    </fieldset>

                    <div class="buttons">
                        <div class="">{{__('messages.confirmprivacy')}} <a href="{{asset('/privacy')}}" class="agree"><b>{{__('messages.privacy')}}</b></a>
                            <input type="checkbox" name="agree" required>&nbsp;
                            <input type="submit" value="{{__('messages.continue')}}" class="btn btn-primary">
                        </div>
                    </div>

                </form>
            </div>
          
      </div>
      </div>
    </div>

<div class="clearfix"></div>
@endsection
