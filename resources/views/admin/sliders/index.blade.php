@extends('admin.include.master')
@section('title') لوحة التحكم | اضافة سليدر @endsection
@section('content')

    <section class="content">
            <div class="row">
                <div class="col-xs-12">  
                    <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">إضافة سليدر </h3>
                    </div>
                
                {!! Form::open(array('method' => 'POST','files'=> true ,'url' =>'adminpanel/sliders')) !!}
                    <div class="box-body">

                        <div class="form-group col-md-12">
                            <label>عنوان السلايدر باللغة العربية</label>
                            <input type="text" class="form-control" name="artitle" placeholder="عنوان السلايدر باللغة العربية" value="{{ old('artitle') }}" required>
                            @if ($errors->has('artitle'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('artitle') }}</div>
                            @endif  
                        </div>

                        <div class="form-group col-md-12">
                            <label>عنوان السلايدر باللغة الانجليزية</label>
                            <input type="text" class="form-control" name="entitle" placeholder="عنوان السلايدر باللغة الانجليزية" value="{{ old('entitle') }}" required>
                            @if ($errors->has('entitle'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('entitle') }}</div>
                            @endif  
                        </div>

                        <div class="form-group col-md-12">
                            <label>نص السلايدر باللغة العربية</label>
                            <input type="text" class="form-control" name="artext" placeholder="نص السلايدر باللغة العربية" value="{{ old('artext') }}" required>
                            @if ($errors->has('artext'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('artext') }}</div>
                            @endif  
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label>نص السلايدر باللغة الانجليزية</label>
                            <input type="text" class="form-control" name="entext" placeholder="نص السلايدر باللغة الانجليزية" value="{{ old('entext') }}" required>
                            @if ($errors->has('entext'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('entext') }}</div>
                            @endif  
                        </div>

                        <div class="form-group col-md-12">
                            <label>رابط السلايدر</label>
                            <input type="text" class="form-control" name="url" placeholder="رابط السلايدر" value="{{ old('url') }}" required>
                            @if ($errors->has('url'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('url') }}</div>
                            @endif  
                        </div>

                        <div class="form-group col-md-6">
                            <label>صورة السلايدر</label>
                            <input type="file" class="form-control" name="image" required>
                            @if ($errors->has('image'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                            @endif  
                        </div>
                        <div class="form-group col-md-6">
                            <label>صورة تفاصيل السلايدر</label>
                            <input type="file" class="form-control" name="dimage" required>
                            @if ($errors->has('dimage'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('dimage') }}</div>
                            @endif  
                        </div>
                        <!--<div class="form-group col-md-6">-->
                        <!--    <label>مكان السلايدر</label>-->
                        <!--    <select id="changetype" class="form-control" name="top">-->
                        <!--        <option value="1" selected="">ف الاعلى</option>-->
                        <!--        <option value="0">ف الاسفل</option>-->
                        <!--    </select>  -->
                        <!--</div>-->
                        <!--@if(session('error'))-->
                        <!--    <div style="color: crimson;font-size: 18px;padding: 1%;" class="text-center">{{session('error')}}</div>-->
                        <!--    {{session()->forget('error')}}-->
                        <!--@endif-->
                    </div>

                    <div class="box-footer">
                    <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                    {!! Form::close() !!}
            </div>
            </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">  

                <div class="box-header with-border">
                    <h3 class="box-title">كل  السلايدر</h3>
                </div>    

                <div class="table-responsive box-body">
                <button style="margin-bottom: 10px;float:left;" class="btn btn-danger delete_all" data-url="{{ url('mysliderDeleteAll') }}"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف المحدد</button>
                    <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">صورة السلايدر</th>
                                      <th style="text-align:center;">صورة تفاصيل السلايدر</th>
                                    <th style="text-align:center;">عنوان السلايدر</th>
                                    <th style="text-align:center;">نص السلايدر</th>
                                    <th style="text-align:center;">تعطيل</th>
                                    <th style="text-align:center;"> تعديل</th>
                                    <th style="text-align:center;"> حذف</th> 
                                    <th width="50px"><input type="checkbox" id="master"></th>
                                </tr>
                            </thead>
                    
                            <tbody> 
                                @foreach($allsliders as $slider)
                                    <tr>
                                        <td><img style="width:100px;height:100px;" src="{{asset('users/images/'.$slider->image)}}" alt="{{$slider->artitle}}"></td>
                                         <td><img style="width:100px;height:100px;" src="{{asset('users/images/'.$slider->img_details)}}" alt="{{$slider->artext}}"></td>
                                        <td>{{$slider->artitle}}</td>
                                         <td>{{$slider->artext}}</td>
                                        <td>
                                            {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متاكد ؟!')",'files' => true,'url' =>'adminpanel/sliders/'.$slider->id )) }}
                                                <input type="hidden" name="suspensed" >
                                                <button type="submit" class="btn btn-default">
                                                @if($slider->suspensed == 1) 
                                                <i style="color:crimson" class="fa fa-lock" aria-hidden="true"></i> 
                                                @else 
                                                <i style="color:#1FAB89" class="fa fa-unlock" aria-hidden="true"></i> 
                                                @endif
                                                </button>
                                            {!! Form::close() !!}
                                        </td>

                                        <td>
                                            <a href='{{asset("adminpanel/sliders/".$slider->id."/edit")}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </td>

                                        <td>
                                            {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/sliders/'.$slider->id))) }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                        <td><input type="checkbox" class="sub_chk" data-id="{{$slider->id}}"></td>
                                    </tr>
                            @endforeach
                            </tbody> 
                    </table>
                </div>

                </div>    
            </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#master').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".sub_chk").prop('checked', true);  
            } else {  
                $(".sub_chk").prop('checked',false);  
            }  
            });

            $('.delete_all').on('click', function(e) {
                var allVals = [];  
                $(".sub_chk:checked").each(function() {  
                    allVals.push($(this).attr('data-id'));
                });  


                if(allVals.length <=0)  
                {  
                    alert("حدد عنصر واحد ع الاقل ");  
                }  else {  
                    var check = confirm("هل انت متاكد؟");  
                    if(check == true){  
                        var join_selected_values = allVals.join(","); 
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {  
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                    $.each(allVals, function( index, value ) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                    }  
                }  
            });


            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });

            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();

                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                return false;
            });
        });
    </script>

@endsection 