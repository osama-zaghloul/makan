@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}  @endsection
@section('content')

<div class="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
               @foreach ($allsliders as $slider)
                   
               
                <div class="swiper-slide">
                    <div class="img_slider">
                        {{-- <img src="{{asset('users/images/bg_slider.jpg')}}" alt=""> --}}
                        <img src="{{asset('users/images/'.$slider->image)}}" alt="">
                    </div>
                    {{-- <div class="details_slider">
                        <div class="container">
                            <div class="text_slide">
                                <h3>@if(session('locale')=='ar') {{$slider->artitle}}@else {{$slider->entitle}}@endif</h3>
                                <h1>@if(session('locale')=='ar') {{$slider->artext}}@else {{$slider->entext}}@endif</h1>
                                <a href="#">{{session('locale')=='ar' ? 'المزيد' : 'More'}}</a>
                            </div>
                            <div class="img_details">
                                <img src="{{asset('users/images/'.$slider->img_details)}}" alt="">
                            </div>
                        </div>
                    </div> --}}
                </div>
                @endforeach  
            </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        </div>
    </div>


    <div class="section_all">
        <div class="container text-center">
            <div class="title">
                <h1>{{session('locale')=='ar' ? 'الأقسام' : 'Categories'}}</h1>
                <img src="{{asset('users/images/title.png')}}" alt="">
            </div>
            <div class="row">
                @foreach ($allcategories as $category)
                    
                
                <div class="col-md-12">
                    <div class="sec_one">
                        <img src="{{asset('users/images/'.$category->image)}}" alt="">
                        <div class="btn_sec">
                            <a href="{{asset('/categories/'.$category->id)}}"> @if(session('locale')=='ar') {{$category->arcategory}}@else {{$category->encategory}}@endif </a>
                        </div>
                    </div>
                </div>

                @endforeach
                

            </div>
        </div>
    </div>

    @endsection