@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale')=='ar' ? 'معلومات الشحن والتوصيل' : 'Shipping and delivery information'}}@endsection
@section('content')
<div class="title_page">
    <div class="container">
        <ul>
        <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}  /</a></li>
                <li>
                    
                    {{session('locale')=='ar' ? 'معلومات الشحن والتوصيل' : 'Shipping and delivery information'}}
 
                </li>
        </ul>
    </div>
</div>

<div class="pages">
    <div class="container">
        <div class="trems text-center">
        <p>{{$shipping[$lang.'shipping']}}</p>
        </div>
    </div>
</div>

@endsection