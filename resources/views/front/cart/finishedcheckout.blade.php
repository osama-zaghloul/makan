@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}}  | {{ __('messages.finishedcheckout') }}  @endsection
@section('content')
<div class="clearfix"></div>

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.finishedcheckout')}}</li>
            </ul>
        </div>
    </div>


    <div class="pages">
        <div class="checkout-cart">
           <h3 class="text-center">{{$successmessage}}</h3>
           <br><br><br>
           <div class="buttons">
                <div style="text-align: center;">
                    <a href="{{asset('/')}}" class="btn btn-primary">{{__('messages.continueshop')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
@endsection 