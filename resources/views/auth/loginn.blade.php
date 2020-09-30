@extends('front.include.master')
@section('title') {{__('messages.hsc')}} | {{__('messages.login')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.login')}} </li>
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
                        <h2>{{__('messages.register')}}</h2>
                        <p>{{__('messages.haveaccount')}}</p>
                        <a href="{{ route('register') }}" class="btn btn-primary">{{__('messages.continue')}}</a></div>
                    </div>

                    <div class="col-sm-6">
                        <div class="well">
                            <h2>{{__('messages.login')}}</h2>
                            <p><strong>{{__('messages.haveaccount2')}}</strong></p>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-group">
                                        <label class="control-label" for="input-phone">{{__('messages.phone')}}:</label>
                                        <input type="text" name="phone" placeholder="{{__('messages.phone')}}" id="input-phone" value="{{old('phone')}}" class="form-control">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="input-password">{{__('messages.password')}}:</label>
                                        <input type="password" name="password" value="" placeholder="{{__('messages.password')}}" id="input-password" class="form-control">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span><br>
                                        @endif

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">{{__('messages.forgetpass')}}</a>
                                        @endif
                                        <p class="pull-left">{{__('messages.haveaccount3')}} <a href="{{route('register')}}">{{__('messages.register')}}</a></p>
                                        
                                    </div>
                                <input type="submit" value="{{__('messages.login')}}" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        </div>
    </div>


@endsection
