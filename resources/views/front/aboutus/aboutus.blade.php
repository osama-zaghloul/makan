@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.aboutsite')}} @endsection
@section('content')

<div class="title_page">
    <div class="container">
        <ul>
        <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}  /</a></li>
                <li>
                    
                    {{session('locale')=='ar' ? 'من نحن' : 'About us'}} 
 
                </li>
        </ul>
    </div>
</div>

<div class="pages">
    <div class="container">
        <div class="trems text-center">
        <p>{{$about[$lang.'about']}}</p>
        </div>
    </div>
</div>


@endsection