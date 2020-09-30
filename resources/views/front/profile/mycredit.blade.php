@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale')=='ar' ? 'رصيدي' : 'my credit'}} @endsection
@section('content')


<div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{session('locale')=='ar' ? 'رصيدي' : 'my credit'}}</li>
            </ul>
        </div>
    </div>

<div class="pages">
        <div class="orders">
            <div class="container text-center">
            <table>
                <h3>{{session('locale')=='ar' ? '   رصيدي:   00 ر.س ' : 'my credit : 00 SAR'}}</h3>
            
            </table>
            </div>
        </div>
</div>

@endsection 
