@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.bankaccounts')}} @endsection
@section('content')

    <div class="title_page mb-5">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.bankaccounts')}}</li>
            </ul>
        </div>
        
        
                
    </div>
    <div class="pages">
    <div class="banks_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box_banks">
                        <div class="col-md-3">
                            <div class="img_bank">
                                <img src="{{asset('users/images/ahly.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="details_banks">
                                <h1>البنك الاهلى</h1>
                                <h3> الرقم الشخصى : <span>  123456789</span></h3>
                                <h3>IBAN  : <span>SA123456789101112</span></h3>
                                <h3> رقم الحساب <span>21212121212</span></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box_banks">
                        <div class="col-md-3">
                            <div class="img_bank">
                                <img src="{{asset('users/images/smba.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="details_banks">
                                <h1> بنك سامبا</h1>
                                <h3> الاسم <span>مكان</span></h3>
                                <h3>IBAN <span>SA123456789101112</span></h3>
                                <h3> رقم الحساب <span>12345678</span></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box_banks">
                        <div class="col-md-3">
                            <div class="img_bank">
                                <img src="{{asset('users/images/raghy.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="details_banks">
                                <h1> مصرف الراجحى</h1>
                                <h3> الاسم <span>مكان</span></h3>
                                <h3>IBAN <span>SA123456789101112</span></h3>
                                <h3> رقم الحساب <span>1234567</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 