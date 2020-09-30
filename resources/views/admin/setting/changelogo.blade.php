@extends('admin.include.master')
@section('title') لوحة التحكم | اعدادات التطبيق @endsection
@section('content')

<section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box-header">
                <h3 class="box-title">اعدادات التطبيق</h3>
            </div>  
                <div class="box">
                    {{ Form::open(array('method' => 'PATCH','files' => true,'url' =>'adminpanel/setapp/'.$changelogo->id )) }}
                        <input type="hidden" name="addbrand">
                        <div class="box-body">

                        <div class="form-group col-md-6">
                            
                           <div class="form-group col-md-12">
                                <label>لوجو  التطبيق</label>
                                <input style="width:100%;" type="file" class="form-control" name="logo">
                                @if ($errors->has('logo'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>الضريبة </label>
                                <input style="width:100%;" type="text" class="form-control" placeholder="الضريبة" name="tax" value="{{$changelogo->tax}}">
                                @if ($errors->has('tax'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('tax') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>مصاريف الشحن للشحنة كاملة </label>
                                <input style="width:100%;" type="text" class="form-control" placeholder="مصاريف الشحن للشحنة كاملة" name="shipping" value="{{$changelogo->shipping}}">
                                @if ($errors->has('shipping'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('shipping') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>مصاريف الشحن بالقطعة </label>
                                <input style="width:100%;" type="text" class="form-control" placeholder="مصاريف الشحن بالقطعة" name="shipping_item" value="{{$changelogo->shipping_item}}">
                                @if ($errors->has('shipping_item'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('shipping_item') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label>رقم الجوال</label>
                                <input style="width:100%;" type="text" class="form-control" placeholder="رقم الجوال" name="phone" value="{{$changelogo->phone}}">
                                @if ($errors->has('phone'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>رقم الواتساب</label>
                                <input style="width:100%;" type="text" class="form-control" placeholder="رقم الواتساب" name="whatsapp" value="{{$changelogo->whatsapp}}">
                                @if ($errors->has('whatsapp'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('whatsapp') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label>البريد الالكترونى</label>
                                <input style="width:100%;" type="text" class="form-control" placeholder="البريد الالكترونى" name="email" value="{{$changelogo->email}}" >
                                @if ($errors->has('email'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                        </div>

      
                         <div class="form-group col-md-6">
                            <label>صورة لوجو  التطبيق </label>
                            <div style="margin-bottom: 0;" class="login-logo">
                                <img class="img-thumbnail" style="height: 10%;" src="{{asset('users/images/'.$changelogo->logo)}}" alt="Logo"><br>
                            </div>
                        </div>

                        <div style="padding: 24px;" class="box-footer col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-primary col-md-12">تغيير</button>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div> 
        </div>
        </div>
</section>

<!--<section class="content">-->
<!--        <div class="row">-->
<!--        <div class="col-md-12">-->
<!--        <div class="box-header">-->
<!--                <h3 class="box-title">مواقع التواصل الاجتماعى </h3>-->
<!--            </div>  -->
<!--                   <div class="box box-danger">-->
<!--                    {{ Form::open(array('method' => 'PATCH','files' => true,'url' =>'adminpanel/setapp/'.$changelogo->id )) }}-->
<!--                        <input type="hidden" name="updatesocial">-->
<!--                        <div class="box-body">-->


<!--                        <div class="form-group col-md-12">-->
<!--                            <label>موقع تويتر</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->twitter}}" placeholder="موقع تويتر" class="form-control" name="twitter">-->
<!--                            @if ($errors->has('twitter'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('twitter') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->


<!--                        <div class="form-group col-md-12">-->
<!--                            <label>موقع الانستجرام</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->instagram}}" placeholder="موقع الانستجرام" class="form-control" name="instagram">-->
<!--                            @if ($errors->has('instagram'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('instagram') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->
                        
<!--                        <div class="form-group col-md-12">-->
<!--                            <label>موقع سناب شات</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->snapchat}}" placeholder="موقع سناب شات" class="form-control" name="snapchat">-->
<!--                            @if ($errors->has('snapchat'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('snapchat') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->
                        
<!--                        <div class="form-group col-md-12">-->
<!--                            <label>موقع التليجرام</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->telegram}}" placeholder="موقع التليجرام" class="form-control" name="telegram">-->
<!--                            @if ($errors->has('telegram'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('telegram') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->
                        
<!--                        <div class="form-group col-md-12">-->
<!--                            <label>موقع اليوتيوب</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->youtube}}" placeholder="موقع اليوتيوب" class="form-control" name="youtube">-->
<!--                            @if ($errors->has('youtube'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('youtube') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->


<!--                        <div class="form-group col-md-12">-->
<!--                            <label>لينك التطبيق ع جوجل بلاى (اندرويد)</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->googleplay}}" placeholder="لينك التطبيق ع جوجل بلاى (اندرويد)" class="form-control" name="googleplay">-->
<!--                            @if ($errors->has('googleplay'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('googleplay') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->

<!--                        <div class="form-group col-md-12">-->
<!--                            <label>لينك التطبيق ع ابل ستور (ايفون)</label>-->
<!--                            <input style="width:100%;" type="text" value="{{$changelogo->applestore}}" placeholder="لينك التطبيق ع ابل ستور (ايفون)" class="form-control" name="applestore">-->
<!--                            @if ($errors->has('applestore'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('applestore') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->

<!--                        <div style="padding: 24px;" class="box-footer col-md-offset-4 col-md-4">-->
<!--                            <button type="submit" class="btn btn-primary col-md-12">تغيير</button>-->
<!--                        </div>-->
<!--                    {!! Form::close() !!}-->
<!--                    </div>-->
<!--                </div> -->
<!--        </div>-->
<!--        </div>-->
<!--</section>-->

<!--<section class="content">-->
<!--        <div class="row">-->
<!--        <div class="col-md-12">-->
<!--        <div class="box-header">-->
<!--                <h3 class="box-title">ارسال الاشعارات لجميع المستخدمين</h3>-->
<!--            </div>  -->
<!--                   <div class="box box-danger">-->
<!--                    {{ Form::open(array('method' => 'POST','url' =>'adminpanel/setapp')) }}-->
<!--                        <div class="box-body">-->

<!--                        <div class="form-group col-md-12">-->
<!--                        <label>محتوى الاشعار</label>-->
<!--                            <input style="width:100%;" type="text" class="form-control" name="notification">-->
<!--                            @if ($errors->has('notification'))-->
<!--                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('notification') }}</div>-->
<!--                            @endif-->
<!--                        </div>-->
                        
<!--                        <div style="padding: 24px;" class="box-footer col-md-offset-4 col-md-4">-->
<!--                            <button type="submit" class="btn btn-primary col-md-12">ارسال</button>-->
<!--                        </div>-->
<!--                    {!! Form::close() !!}-->
<!--                    </div>-->
<!--                </div> -->
<!--        </div>-->
<!--        </div>-->
<!--</section>-->


@endsection