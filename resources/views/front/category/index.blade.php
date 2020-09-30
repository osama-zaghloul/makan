@extends('front.include.master')
@section('title') {{__('messages.hsc')}} | {{__('messages.categories')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.categories')}}</li>
            </ul>
        </div>
    </div>

    
    <!-- Categories -->
    <div class="latest_products">
        <div class="container text-center">

            <div class="title">
                <h1>{{__('messages.categories')}}</h1>
                <img src="{{asset('users/images/title.jpg')}}" alt="">
            </div>

            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-3">
                        <div class="box_sec">
                            <img src="{{asset('users/images/'.$category->image)}}" alt="{{$category->arcategory}}">
                            <div class="tit_sec">
                                <a href="{{asset('/categories/'.$category->id)}}">{{ session('locale') == 'en' ? $category->encategory : $category->arcategory}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection