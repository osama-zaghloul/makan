@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.profile')}} @endsection
@section('content')

 <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'معلومات حسابي' : 'my profile'}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
    <div id="account-login" class="container">
          <div class="row">
          <aside id="column-right" class="col-sm-3 hidden-xs">
            <div class="list-group">
                
                <a href="{{asset('profile/')}}" class="list-group-item @if($mainactive == 'myprofile')  active @endif ">{{session('locale')=='ar' ? 'حسابي' : 'my profile'}}</a>
                <a href="{{asset('mynotification/')}}" class="list-group-item @if($mainactive == 'myadress')  active @endif ">{{session('locale')=='ar' ? 'الإشعارات' : 'notifications'}}</a> 
                <a href="{{asset('myfavorites/')}}" class="list-group-item @if($mainactive == 'myfavorites')  active @endif ">{{session('locale')=='ar' ? 'قائمة رغباتي' : 'my favorites'}}</a> 
                <a href="{{asset('myorders/')}}" class="list-group-item @if($mainactive == 'myorders')  active @endif ">{{session('locale')=='ar' ? 'طلباتي' : 'my orders'}}</a> 
                <a href="{{asset('returnorders/')}}" class="list-group-item @if($mainactive == 'returnorders')  active @endif ">{{session('locale')=='ar' ? 'المنتجات المرتجعة' : 'returned products'}}</a> 
                <a href="{{asset('mycredit/')}}" class="list-group-item @if($mainactive == 'myaccount')  active @endif ">{{session('locale')=='ar' ? 'رصيدي' : 'my credit'}}</a> 
              </div>
          </aside>
          {!! Form::open(array('method' => 'patch','files' => true,'url' =>'profile/'.$myprofile->id)) !!}

          <div id="content" class="col-sm-9">
      

        
        <fieldset>
          <legend>{{session('locale')=='ar' ? 'معلوماتك الشخصية' : 'Personal information '}}</legend>
          <div class="form-group required ">
            <label class="col-sm-2 control-label" for="input-firstname">{{session('locale')=='ar' ? 'الاسم الأول' : 'first name'}} </label>
            <div class="col-sm-10 ">
              <input type="text" name="name" value="{{$myprofile->name}}" placeholder="{{session('locale')=='ar' ? 'الاسم الأول' : 'first name'}}" id="input-firstname" class="form-control" required>
              @if ($errors->has('name'))
                     <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
              @endif
            </div>
          </div>
          <br><br>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-lastname">{{session('locale')=='ar' ? 'اسم العائلة' : 'last name'}}</label>
            <div class="col-sm-10">
              <input type="text" name="lastname" value="{{$myprofile->lastname}}" placeholder="{{session('locale')=='ar' ? 'اسم العائلة' : 'last name'}}" id="input-lastname" class="form-control" required>

              @if ($errors->has('lastname'))
                     <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('lastname') }}</strong></span>
              @endif
             </div>
          </div>
          <br><br>
          <!--<div class="form-group required">-->
          <!--  <label class="col-sm-2 control-label" for="input-email">{{session('locale')=='ar' ? 'البريد الالكتروني' : 'Email'}}</label>-->
          <!--  <div class="col-sm-10">-->
          <!--    <input type="email" name="email" value="{{$myprofile->email}}" placeholder="{{session('locale')=='ar' ? 'البريد الالكتروني' : 'Email'}}" id="input-email" class="form-control" required>-->

          <!--    @if ($errors->has('email'))-->
          <!--           <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>-->
          <!--    @endif-->
          <!--     </div>-->
          <!--</div>-->
          <!--<br><br>-->
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">{{session('locale')=='ar' ? 'رقم الجوال' : 'phone'}}</label>
            <div class="col-sm-10">
              <input type="tel" name="phone" value="{{$myprofile->phone}}" placeholder="{{session('locale')=='ar' ? 'رقم الجوال' : 'phone'}}" id="input-telephone" class="form-control" required>

              @if ($errors->has('phone'))
                     <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
              @endif
             </div>
          </div>
          <br><br>
          
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">{{session('locale')=='ar' ? 'المنطقة' : 'zone'}}</label>
            <div class="col-sm-10">
              <input type="text" name="address" value="{{$myprofile->address}}" placeholder="{{session('locale')=='ar' ? 'المنطقة ' : 'zone'}}" id="input-address" class="form-control" required>

              @if ($errors->has('address'))
                     <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
              @endif
             </div>
          </div>
          <br><br>
          
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">{{session('locale')=='ar' ? 'الحي' : 'district'}}</label>
            <div class="col-sm-10">
              <input type="text" name="district" value="{{$myprofile->district}}" placeholder="{{session('locale')=='ar' ? 'الحي ' : 'district'}}" id="input-address" class="form-control" required>

              @if ($errors->has('district'))
                     <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('district') }}</strong></span>
              @endif
             </div>
          </div>
          <br><br>
          </fieldset>
        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" value="{{session('locale')=='ar' ? 'حفظ' : 'save'}}" class="btn btn-primary">
          </div>
        </div>
      
     
      </div>
         {!! Form::close() !!}
      </div>
    </div>
    </div>
@endsection