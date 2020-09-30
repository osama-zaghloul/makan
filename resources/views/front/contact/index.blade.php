@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.contactus')}} @endsection
@section('content')

<div class="title_page">
    <div class="container">
        <ul>
            <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
            <li>{{session('locale')=='ar' ? 'تواصل معنا' : 'contact us'}}</li>
        </ul>
    </div>
</div>

<div class="pages">
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="contact_footer"> 
                        <h1 class="title_footer">{{session('locale')=='ar' ? 'تواصل معنا' : 'contact us'}}</h1>
                        <p>
                            <div class="fl_lef">
                                <h3>{{$info->email}}</h3>
                            </div>
                        </p>
                        <br>

                        <p>
                            <div class="fl_lef">
                                <h3>{{$info->whatsapp}}</h3>
                            </div>
                        </p>
                        
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="message_contact">
                        <h1>{{session('locale')=='ar' ? 'ارسال رسالة' : 'Send message'}}</h1>
                    <form action="{{asset('contactus/')}}" method="post">
                        @csrf
                            <div class="col-md-6">
                                <input type="text" name="name" @guest @else value="{{Auth()->user()->name}}" @endif required placeholder="{{session('locale')=='ar' ? 'الاسم' : 'name'}}" id="" required/>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span><br>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" @guest @else value="{{Auth()->user()->email}}" @endif  placeholder="{{session('locale')=='ar' ? 'الايميل' : 'email'}}" id="" required />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span><br>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <textarea placeholder="{{session('locale')=='ar' ? 'الرسالة' : 'message'}}"  name="message" required></textarea>
                                @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('message') }}</strong></span><br>
                                 @endif
                            </div>

                            <div class="col-md-12">
                                <div class="btn_reg">
                                    <button type="submit">{{session('locale')=='ar' ? 'إرسال' : 'send'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection