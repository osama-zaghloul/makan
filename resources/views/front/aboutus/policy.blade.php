@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.policy')}} @endsection
@section('content')

<div class="title_page">
    <div class="container">
        <ul>
        <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}  /</a></li>
                <li>
                    
                    {{session('locale')=='ar' ? 'الشروط والأحكام' : 'conditions'}} 
 
                </li>
        </ul>
    </div>
</div>

<div class="pages">
    <div class="container">
        <div class="trems text-center">
        <p>{{$policy[$lang.'conditions']}}</p>
        </div>
    </div>
</div>


@endsection