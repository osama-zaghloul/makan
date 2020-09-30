@extends('front.include.master')
@section('title') {{__('messages.hsc')}}  | {{__('messages.rechangepassword')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.rechangepassword')}}</li>
            </ul>
        </div>
    </div>


    <div class="pages">
        <div id="account-login" class="container">
            <div class="row">
            
            <div id="content" class="col-sm-9">
                <div class="row">

                    <div class="col-sm-6">
                    </div>

                    <div class="col-sm-6">
                        <div class="well">
                            <h2>{{__('messages.rechangepassword')}}</h2>
                            <form method="POST" action="{{asset('/forgotpassword')}}">
                            @csrf
                                <div class="form-group required">
                                    <input type="hidden" name="rechangepassword" value="{{session()->get( 'data')}}">
                                    <label class="control-label" for="input-password">{{__('messages.password')}}</label>
                                    <input type="password" name="password" placeholder="{{__('messages.password')}}" id="input-password" class="form-control" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group required">
                                    <label class="control-label" for="input-confirm">{{__('messages.confirmpass')}}</label>
                                    <input type="password" name="password_confirmation" placeholder="{{__('messages.confirmpass')}}" id="input-confirm" class="form-control" required>
                                </div>

                                <input type="submit" value="{{__('messages.save')}}" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        </div>
    </div>

<div class="clearfix"></div>
@endsection
