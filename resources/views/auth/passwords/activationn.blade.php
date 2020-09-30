@extends('front.include.master')
@section('title') {{__('messages.hsc')}}  | {{__('messages.activation')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.activation')}}</li>
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
                            <h2>{{__('messages.activation')}}</h2>
                            <form method="POST" action="{{asset('/forgotpassword')}}">
                            @csrf
                                <div class="form-group">
                                    <input type="hidden" name="activecode" value="{{session()->get( 'data')}}">
                                    <label class="control-label" for="input-phone">{{__('messages.code')}}:</label>
                                    <input type="text" name="code" value="" placeholder="{{__('messages.code')}}" id="input-phone" class="form-control">
                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('code') }}</strong></span>
                                    @endif
                                </div>
                                <input type="submit" value="{{__('messages.activenow')}}" class="btn btn-primary">
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
