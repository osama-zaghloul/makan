@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}}  | {{ __('messages.checkout') }}  @endsection
@section('content')
<div class="clearfix"></div>

<div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'تأكيد الطلب' : 'confirm order'}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
        <div class="checkout-cart">
            <div class="container">
            <div class="panel-group" id="accordion">
        {!! Form::open(array('method' => 'POST','files' => true,'url' =>'/cart')) !!}
<!--    <div class="panel panel-default">-->
<!--          <div class="panel-heading">-->
<!--            <h4 class="panel-title"><a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle collapsed" aria-expanded="false">{{session('locale')=='ar' ? 'الخطوة 1: تفاصيل الشحن' : 'Step 1: Shipping details-->
<!--'}} <i class="fa fa-caret-down"></i></a></h4>-->
<!--          </div>-->
<!--          <div class="panel-collapse collapse" id="collapse-shipping-address" aria-expanded="false" style="height: 0px;">-->
<!--            <div class="panel-body">-->

      

    <input type="hidden" name="confirmcheckout">

<!--  <div class="form-group required">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-firstname">{{session('locale')=='ar' ? 'الاسم الأول' : 'first name'}} </label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="firstname" value="" placeholder="{{session('locale')=='ar' ? 'الاسم الأول' : 'first name'}} " id="input-shipping-firstname" class="form-control" required>-->
<!--    </div>-->
<!--  </div>-->
<!--  <br><br>-->
<!--  <div class="form-group required">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-lastname">{{session('locale')=='ar' ? 'اسم العائلة' : 'last name'}} </label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="lastname" value="" placeholder="{{session('locale')=='ar' ? 'اسم العائلة' : 'last name'}} " id="input-shipping-lastname" class="form-control" required>-->
<!--    </div>-->
<!--  </div>-->
<!--<br><br>-->
<!--  <div class="form-group ">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-company">{{session('locale')=='ar' ? 'الشركة' : ' company'}} </label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="company" value="" placeholder="{{session('locale')=='ar' ? 'الشركة' : ' company'}} " id="input-shipping-company" class="form-control" >-->
<!--    </div>-->
<!--  </div>-->
<!--  <br><br>-->
<!--  <div class="form-group required">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-city">{{session('locale')=='ar' ? 'المدينة' : 'City'}} :</label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="city" value="" placeholder="{{session('locale')=='ar' ? 'المدينة' : 'City'}} :" id="input-shipping-city" class="form-control" required>-->
<!--    </div>-->
<!--  </div>-->
<!--  <br><br>-->
<!--  <div class="form-group required">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-address-1">{{session('locale')=='ar' ? 'العنوان الاول' : 'first address'}} :</label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="address" value="" placeholder="{{session('locale')=='ar' ? 'العنوان الاول' : 'first address'}} :" id="input-shipping-address-1" class="form-control" required>-->
<!--    </div>-->
<!--  </div>-->
<!--  <br><br>-->
<!--  <div class="form-group">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-address-2">{{session('locale')=='ar' ? 'العنوان الثاني' : 'second address'}} :</label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="address1" value="" placeholder="{{session('locale')=='ar' ? 'العنوان الثاني' : 'second address'}} :" id="input-shipping-address-2" class="form-control">-->
<!--    </div>-->
<!--  </div>-->
<!--  <br><br>-->
<!--  <div class="form-group">-->
<!--    <label class="col-sm-2 control-label" for="input-shipping-postcode">{{session('locale')=='ar' ? 'صندوق البريد' : 'postcode'}} :</label>-->
<!--    <div class="col-sm-10">-->
<!--      <input type="text" name="postcode" value="" placeholder="{{session('locale')=='ar' ? 'صندوق البريد' : 'postcode'}} :" id="input-shipping-postcode" class="form-control">-->
<!--    </div>-->
<!--  </div>-->
<!--  <br><br>-->
<!--    <div class="buttons">-->
<!--    <div class="pull-right">-->
<!--      <input type="button"  value="{{session('locale')=='ar' ? 'متابعة' : 'continue'}}" id="button-guest-shipping" data-loading-text="جاري ..." class="btn btn-primary">-->
<!--    </div>-->
<!--  </div>-->
<!--<br><br>-->
<!--</div>-->
<!--          </div>-->
<!--        </div>-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#collapse-shipping-method" id="Shipping_method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle collapsed" aria-expanded="false">{{session('locale')=='ar' ? 'الخطوة 1: طريقة الشحن' : 'Step 1: Shipping method
'}} <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse " id="collapse-shipping-method" aria-expanded="false" style="height: 0px;">
            <div class="panel-body"><p>{{session('locale')=='ar' ? 'الرجاء اختيار طريقة الشحن المفضلة لهذا الطلب' : 'Please choose your preferred shipping method for this order
'}}.</p>

<p><strong>{{session('locale')=='ar' ? 'تكلفة ثابتة' : 'Fixed cost
'}}</strong></p>
<div class="radio">
  <label>     <input type="radio" name="shipping_method" id="shipping_method1" value="0" checked>
        {{session('locale')=='ar' ? 'تكلفة ثابتة للشحن - 250 ريال' : 'Fixed shipping cost - 250 riyals
'}}</label>
</div>
<p><strong>{{session('locale')=='ar' ? 'بالقطعة' : 'per piece'}}</strong></p>
<div class="radio">
  <label>     <input type="radio" name="shipping_method" id="shipping_method2"  value="1">
        {{session('locale')=='ar' ? 'قيمة الشحن للقطعة - 30.00 ريال ' : 'Shipping value for a piece -  30.00 SAR
'}}</label>
</div>
<p><strong>{{session('locale')=='ar' ? 'تسليم يد بيد' : 'Hand hand in hand
'}}</strong></p>
<div class="radio">
  <label>     <input type="radio" name="shipping_method" id="shipping_method" value="2">
       {{session('locale')=='ar' ? 'الاستلام من الشركة - 00 ريال' : 'Receipt from the company - 00 riyals
'}} </label>
</div>

<div class="buttons">
  <div class="pull-right">
    <input type="button" onclick = "return addcart()" value="{{session('locale')=='ar' ? 'متابعة' : 'continue'}}" id="button-shipping-method" data-loading-text="جاري ..." class="btn btn-primary">
  </div>
</div>
</div>
          </div>
        </div>
                <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle collapsed" aria-expanded="false">{{session('locale')=='ar' ? 'الخطوة 2: طريقة الدفع' : 'Step 2: Payment method
'}} <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-payment-method" aria-expanded="false" style="height: 0px;">
            <div class="panel-body"><p>{{session('locale')=='ar' ? 'الرجاء اختيار طريقة الدفع المفضلة لهذا الطلب' : 'Please choose your preferred payment method for this order
'}}.</p>
<div class="radio">
  <label>        <input type="radio" name="payment_method" value="0" checked="checked">
        {{session('locale')=='ar' ? 'الدفع عند الاستلام' : 'Cash on delivery'}}
     </label>
</div>
<div class="radio">
  <label>        <input type="radio" name="payment_method" value="1" checked="checked">
        {{session('locale')=='ar' ? 'التحويل البنكي' : 'Bank transfer'}}
     </label>
</div>
<p><strong>{{session('locale')=='ar' ? 'كتابة ملاحظات مع الطلب' : 'Write notes with the order
'}}.</strong></p>
<p>
  <textarea name="details" rows="8" class="form-control"></textarea>
</p>
<div class="buttons">
  <div class="pull-right">{{session('locale')=='ar' ? 'لقد قرأت ووافقت على' : 'I have read and agree to
'}} <a href="{{asset('policy/')}}" class="agree"><b>{{session('locale')=='ar' ? 'شروط الاستخدام' : 'Terms of use'}}</b></a>
        <input type="checkbox" name="agree" value="1" required>
        &nbsp;
    <input type="button" value="{{session('locale')=='ar' ? 'متابعة' : 'continue'}}" id="button-payment-method" data-loading-text="جاري ..." class="btn btn-primary">
  </div>
</div>
 </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#collapse-checkout-confirm" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle collapsed" aria-expanded="false">{{session('locale')=='ar' ? 'الخطوة 3: تأكيد الطلب' : 'Step 3: Confirm the order
'}} <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-checkout-confirm" aria-expanded="false" style="height: 0px;">
            <div class="panel-body"><div class="table-responsive">
 
{{-- @if(session('shopping_cart')) --}}
                {{-- <div class="container"> --}}
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>{{__('messages.itemcode')}}</th>
                            <th>{{__('messages.item')}}</th>
                            <th>{{__('messages.qty')}}</th>
                            <th>{{__('messages.price')}}</th>
                        </tr>
                        <?php 
                        $total=0;
                        $count=0
                        ?>
                        @foreach($orders as $order) 
                            <?php
                            $iteminfo = DB::table('items')->where('id',$order->item_id)->first(); 
                            $itempic  = DB::table('item_images')->where('item_id',$order->item_id)->first();
                            $settings = DB::table('settings')->first(); 
                            $taxpercent = $settings->tax;
                            $shipping = $settings->shipping;
                            $shipping_item = $settings->shipping_item;
                            $total +=($order->qty * $order->price);
                            // $total += $total;
                            $count += $order->qty;
                            $tax = round(($total*$taxpercent)/100);
                            $price = $order->price * $order->qty;
                            $total_with_shipping = $total +$shipping+$tax;
                            ?>
                            <tr>
                                <td>{{$iteminfo->code}}</td>
                                <td>
                                <img src="{{asset('users/images/'.$itempic->image)}}" alt="{{$iteminfo->artitle}}">
                                <a href="{{asset('items/'.$iteminfo->id)}}">{{ session('locale') == 'en' ? $iteminfo->entitle : $iteminfo->artitle}}</a>
                                </td>
                                <td>{{$order->qty}}</td>
                                <td>{{$price}} {{__('messages.currancy')}}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                         <tr>
                             <td colspan="3" class=""><strong>{{session('locale')=='ar' ? 'الاستلام من الشركة' : 'receiving from company'}} :</strong></td>
                             <td class="" > <span id="shipping"> 250 </span> {{__('messages.currancy')}}   </td>
                        </tr>
                        <tr>
                             <td colspan="3" class=""><strong>{{session('locale')=='ar' ? 'الضريبة' : 'Tax'}} :</strong></td>
                             <td class="" > <span id="tax">{{$tax}}</span> {{__('messages.currancy')}}   </td>
                        </tr>
                        <tr>
                            <td colspan="3" class=""><strong>{{__('messages.total')}}:</strong></td>
                            <td class="" ><span id="totalp"> {{$total_with_shipping}} </span> {{__('messages.currancy')}}</td>
                        </tr>
                    </tfoot>
                    </table>
                    
                {{-- </div> --}}
            {{-- @endif --}}
</div>
<input type="hidden" name="total" id="total" value="{{$total}}">
 <input type="hidden" name="count" id="ship" value="{{$count}}"> 
  <input type="hidden" name="tax" id="tax" value="{{$tax}}"> 

<div class="buttons">
  <div class="pull-right">
    <input type="submit" value="{{session('locale')=='ar' ? 'تأكيد الطلب' : 'confirm'}}" id="button-confirm" data-loading-text="جاري ..." class="btn btn-primary">
  </div>
</div>


 </div>
          </div>
        </div>
      </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @section('script')
        <script type="text/javascript">
        
            function addcart() 
            {
                // var shipmethod =  jQuery("#shipping_method1").attr('checked', true);
                // var shipmethod = $("#shipping_method").val();
                if(document.querySelector("#shipping_method1").checked)
                {
                        document.querySelector("#shipping").textContent = {{$shipping}};
                        document.querySelector("#totalp").textContent = {{$total}} + {{$shipping}} + {{$tax}} ;
                        // document.querySelector("#ship").val = 250;
                        // document.querySelector("#total").val = {{$total}} + 250;
                        // var total = document.querySelector("#total").val;
                        // session()->put('total',{{$total}} + 250);
                        
                }
                if(document.querySelector("#shipping_method2").checked)
                {
                    
                    var shipping = {{$count}} * {{$shipping_item}}  ;
                   
                    document.querySelector("#shipping").textContent =shipping;

                    document.querySelector("#totalp").textContent = shipping +  {{$total}} + {{$tax}};

                    // document.querySelector("#ship").val  = shipping;
                    // document.querySelector("#total").val = shipping +  {{$total}};
                    // var x = document.querySelector("#total").val;
                    // console.log(x);
                }
                if(document.querySelector("#shipping_method").checked)
                {
                     document.querySelector("#shipping").textContent =0;

                    document.querySelector("#totalp").textContent ={{$total}} +{{$tax}};
                    // document.querySelector("#ship").val  = 0;
                    // document.querySelector("#total").val = {{$total}};
                    // total = document.querySelector("#total").val;
                    // session()->put('total',total);
                }
                
                   
               
            }

            
        </script>
    @stop
@endsection



