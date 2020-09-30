@extends('front.include.homemaster')
@section('title') {{__('messages.faztrade')}}   |  {{ __('messages.conditions') }}  @endsection
@section('content')

  <div class="bar_title">
        <div class="container">
            <span><a href="{{asset('/')}}">{{ __('messages.home') }} /</a></span> 
            <span>{{ __('messages.conditions') }}</span>
        </div>
    </div>

    <div class="pages">
        <div class="register_page">
            <div class="container">
               {!! session('locale') == 'en' ? $policy->enconditions : $policy->conditions !!}
            </div>
        </div>
    </div>

@endsection 
