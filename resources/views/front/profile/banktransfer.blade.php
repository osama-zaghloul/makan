@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.sendbanktransfer')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.sendbanktransfer')}}</li>
            </ul>
        </div>
    </div>



    <div class="pages">
      <div id="account-register" class="container">
          <div class="row">
            <div id="content" class="col-sm-9">
                {!! Form::open(array('method' => 'post','files' => true,'url' =>'sendbanktransfer/'.$billnumber)) !!}
                    <fieldset id="account">
                        <legend>{{__('messages.sendbanktransfer')}}</legend>
            
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-firstname">{{__('messages.username')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="text" name="name" placeholder="{{__('messages.username')}}" value="{{Auth()->user()->name}}" id="input-firstname" class="form-control" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-telephone">{{__('messages.phone')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="tel" name="phone"  placeholder="{{__('messages.phone')}}" value="{{Auth()->user()->phone}}"  id="input-telephone" class="form-control" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-telephone">{{__('messages.transferimage')}}</label>
                            <div style="margin-bottom:20px;" class="col-sm-10">
                                <input type="file" name="image"  placeholder="{{__('messages.transferimage')}}"  class="form-control" required>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('image') }}</strong></span>
                                @endif
                            </div>
                        </div>


                    </fieldset>

                    <div class="buttons">
                        <input type="submit" value="{{__('messages.send')}}" class="btn btn-primary">
                    </div>

                {!! Form::close() !!}
            </div>
          
      </div>
      </div>
    </div>

@endsection 