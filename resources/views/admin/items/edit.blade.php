@extends('admin/include/master')
@section('title') لوحة التحكم | تعديل بيانات المنتج @endsection
@section('content')

<section class="content">
    <div class="row">
      <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">تعديل بيانات المنتج </h3>
          <p> {{ $editem->title}} </p>
        </div>
         
        {!! Form::open(array('method' => 'patch','files' => true,'url' =>'adminpanel/items/'.$editem->id)) !!}
        <div class="box-body">

                  <div class="form-group col-md-6">
                    <label>اسم المنتج باللغة العربية</label>
                    <input type="text" class="form-control" name="artitle" placeholder="ادخل اسم المنتج باللغة العربية" value="{{ $editem->artitle }}" required>
                    @if ($errors->has('artitle'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('artitle') }}</div>
                    @endif  
                  </div>

                  <div class="form-group col-md-6">
                    <label>اسم المنتج باللغة الانجليزية</label>
                    <input type="text" class="form-control" name="entitle" placeholder="ادخل اسم المنتج باللغة الانجليزية" value="{{ $editem->entitle }}" required>
                    @if ($errors->has('entitle'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('entitle') }}</div>
                    @endif  
                  </div>
                  
                <div class="form-group col-md-12">
                    <label>كود المنتج</label>
                    <input type="text" class="form-control" name="code" placeholder="ادخل كود المنتج" value="{{ $editem->code}}" required>
                    @if ($errors->has('code'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('code') }}</div>
                    @endif  
                  </div>

                  <div class="form-group col-md-6">
                        <label>القسم</label>
                        <select class="form-control"  name="category_id" required>
                            <option value="0" disabled="">اختار القسم</option>
                            @foreach($allcats as $cat)
                                <option value="{{$cat->id}}" @if($cat->id == $editem->category_id) selected @endif> {{$cat->arcategory}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('category_id') }}</div>
                        @endif  
                  </div>

                  <div class="form-group col-md-6">
                        <label>القسم الفرعي</label>
                        <select class="form-control"  name="subcategory_id" required>
                            <option value="0" disabled="">اختار القسم الفرعي</option>
                            @foreach($allsubcats as $cat)
                                <option value="{{$cat->id}}" @if($cat->id == $editem->subcategory_id) selected @endif> {{$cat->artitle}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('subcategory_id'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('subcategory_id') }}</div>
                        @endif  
                  </div>

                  

                  <div class="form-group col-md-6">
                    <label>السعر [ريال]</label>
                    <input type="number" name="price" class="form-control" placeholder = 'ادخل السعر' value="{{$editem->price}}" required>
                    @if ($errors->has('price'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('price') }}</div>
                    @endif  
                  </div>

                  <div class="form-group col-md-6">
                        <label>حالة المنتج</label>
                        <select id="itme_offer" class="form-control"  name="offer" required>
                            <option value="0" @if($editem->offer == 0)selected @endif>عادى</option>
                            <option value="1" @if($editem->offer == 1)selected @endif>حالة عرض</option>
                        </select>
                        @if ($errors->has('offer'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('offer') }}</div>
                        @endif  
                  </div>

                  <div id="discountprice" style="display:{{$editem->offer == 1 ? 'block' : 'none'}};" class="form-group col-md-12">
                    <label>السعر بعد الخصم [ريال]</label>
                    <input type="number" name="discountprice" class="form-control" placeholder = 'السعر بعد الخصم' value="{{$editem->discountprice}}">
                    @if ($errors->has('discountprice'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('discountprice') }}</div>
                    @endif  
                  </div>

                   <div class="form-group col-md-6">
                    <label>صور اكثر عن الاعلان [يمكنك رفع اكثر من صورة]</label>
                    <input type="file" name="items[]" multiple>
                    @if ($errors->has('items'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('items') }}</div>
                    @endif  
                  </div>
                  <div class="form-group col-md-6">
                    <label>عدد المتوفر من المنتج</label>
                    <input type="number" name="count" class="form-control" placeholder = 'ادخل عدد المتوفر من المنتج' value="{{$editem->count}}" required>
                    @if ($errors->has('count'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('count') }}</div>
                    @endif  
                  </div>

                  <div class="form-group col-md-12">
                      <label>صور الاعلان</label>
                      <br>
                      @foreach($adimages as $image)
                      <div style="padding: 2%;" class="col-md-3">
                          <img class="img-thumbnail" style="width:100%; height:10%;" src="{{asset('users/images/'.$image->image)}}" alt="">
                      </div>
                      @endforeach
                  </div>

                  <div class="col-md-12">
                      <div class="box box-info">
                          <div class="box-header">
                          <h3 class="box-title" > تفاصيل الاعلان باللغة العربية</h3>
                          </div>
                          <div class="box-body pad">
                              <textarea id="editor1" name="ardesc" rows="10" cols="167" required>{!! $editem->ardesc !!}</textarea>
                              @if ($errors->has('ardesc'))
                                  <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('ardesc') }}</div>
                              @endif
                          </div>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="box box-info">
                          <div class="box-header">
                          <h3 class="box-title" > تفاصيل الاعلان باللغة الانجليزية</h3>
                          </div>
                          <div class="box-body pad">
                              <textarea id="editor2" name="endesc" rows="10" cols="167" required>{!! $editem->endesc !!}</textarea>
                              @if ($errors->has('endesc'))
                                  <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('endesc') }}</div>
                              @endif
                          </div>
                      </div>
                  </div>
               
                <div class="box-footer">
                  <button style="width: 20%;margin-right: 40%;" type="submit" id="submit1" class="btn btn-primary">تعديل</button>
                </div>
        {!! Form::close() !!}
        </div> 
      </div>  
    </div> 
</section>    

<script type="text/javascript">

    $(document).ready(function () {
        $('#itme_offer').change(function() {
         if($(this).val() == 1)  
         {
            $("#discountprice").css('display', 'block');  
         } else {  
            $("#discountprice").css('display', 'none');   
         }  
        });
    });

</script>
@endsection 
