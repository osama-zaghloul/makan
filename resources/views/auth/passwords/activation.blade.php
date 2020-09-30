@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale')=='ar' ? 'التفعيل' : ' activation'}}@endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'أدخل كود التفعيل' : 'Enter activation code'}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
    <div id="account-login" class="container">
          <div class="row">
          

          <div id="content" class="col-sm-9">
      <p>{{session('locale')=='ar' ? 'أدخل كود التعيل الذي تم إرساله إلى ايميلك الخاص' : 'Enter the activation code sent to your e-mail'}}</p>

      <form action="{{ route('using_code') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" name="activecode" value="{{session()->get('data')}}">
        <fieldset>
          <legend>{{session('locale')=='ar' ? 'كود التفعيل ' : 'activation code'}}</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">{{session('locale')=='ar' ? 'كود التفعيل' : 'activation code'}}:</label>
            <div class="col-sm-10">
              <input type="text" name="code" value="" placeholder="{{session('locale')=='ar' ? 'كود التفعيل' : 'activation code'}} :" id="input-email" class="form-control" required>
            </div>
          </div>
          
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" value="{{session('locale')=='ar' ? 'متابعة' : 'continue'}}" class="btn btn-primary">
          </div>
        </div>
      </form>
      </div>
        
      </div>
    </div>
    </div>


@endsection