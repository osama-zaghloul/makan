@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}}  | {{ __('messages.cart') }}  @endsection
@section('content')
<div class="clearfix"></div>

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.cart')}}</li>
            </ul>
        </div>
    </div>


    <div class="pages">
        <div class="checkout-cart">
            @if(session('shopping_cart'))
                <div class="container">
                    {{ Form::open(array('method' => 'post','url' => array('checkout/'))) }}
                    <table>
                        <tbody>
                        <tr>
                            <th>{{__('messages.itemcode')}}</th>
                            <th>{{__('messages.item')}}</th>
                            <th>{{__('messages.qty')}}</th>
                            <th>{{__('messages.price')}}</th>
                            <th>{{__('messages.delfromcart')}}</th>
                        </tr>
                        @foreach($cartitems as $key => $cartitem) 
                            <?php
                                $iteminfo = DB::table('items')->where('id',$cartitem['item_id'])->first(); 
                                $itempic  = DB::table('item_images')->where('item_id',$cartitem['item_id'])->first();
                                $discount = $iteminfo->price - $iteminfo->discountprice;
                                $subtotal = $iteminfo->price *$cartitem['qty'];
                            ?>
                            
                            
                            <tr>
                                <td>{{$iteminfo->code}}</td>
                                <td>
                                <img src="{{asset('users/images/'.$itempic->image)}}" alt="{{$iteminfo->artitle}}">
                                <a href="{{asset('items/'.$iteminfo->id)}}">{{ session('locale') == 'en' ? $iteminfo->entitle : $iteminfo->artitle}}</a>
                                </td>
                                
                                <input type="hidden" value="{{$iteminfo->id}}" name="item_id[]">
                                <input type="hidden" value="{{$iteminfo->price}}" name="price[]" id="item_price">
                                <td>
                                    <div class="quantity">

                                    <input type="number" id="itemqty{{$iteminfo->id}}" class="input-text qty text" step="1" min="1" onchange="return changeprice('{{$iteminfo->price}}','{{$iteminfo->id}}')" max="{{$iteminfo->count}}" name="quantity[]" value="{{$cartitem['qty']}}" title="Qty">
                                    
                                        <div class="quantity-nav">
                                            <div class="quantity-button quantity-up" >+</div>
                                            <div class="quantity-button quantity-down"  >-</div>
                                        </div>
                                    </div>
                        
                                </td>
                                <td ><span id="price{{$iteminfo->id}}">{{$subtotal}}</span> {{__('messages.currancy')}}</td>
                                <td>
                                    {{-- {{ Form::open(array('method' => 'DELETE','url' => array('cart/'.$key))) }}
                                        <input type="hidden" name="deletesessionitem" >
                                        <button type="submit" onclick= "return confirm('هل انت متأكد ؟!')" class="btn-link" href="#">{{__('messages.delfromcart')}}</button>
                                    {!! Form::close() !!} --}}
                                     <a type="button" onclick= "return confirm('هل انت متأكد ؟!')" class="btn-link" href="{{asset('cartdelete/'.$key)}}">{{__('messages.delfromcart')}}</a>
                                    
                                </td>
                            </tr>
                        {{-- <input type="hidden" id="price" value="{{$discount}}">
                        <input type="hidden" id="id" value="{{$iteminfo->id}}"> --}}
                        @endforeach
                        
                    </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="col-right col">
                                {{-- {{ Form::open(array('method' => 'DELETE','url' => array('cart/1'))) }}
                                    <button type="submit" onclick= "return confirm('هل انت متأكد ؟!')" class="btn-link" href="#">{{__('messages.emptymycart')}}</button>
                                {!! Form::close() !!} --}}
                                <a type="button" onclick= "return confirm('هل انت متأكد ؟!')" class="btn-link" href="{{asset('cartdeleteall/')}}">{{__('messages.emptymycart')}}</a>

                                <a class="btn-link" href="{{asset('cart')}}" name="update"><i class="icon-e-17"></i>{{__('messages.updatecart')}}</a>
                            </div>
                        </div>
                        <input type="hidden"  name="store">
                        <div class="col-md-6 col-sm-6">
                            <div class="col-left col">
                                <a class="btn-link"  href="{{asset('/')}}">{{__('messages.continueshop')}}</a>
                            <button type="submit" class="btn-link"  >{{__('messages.continuepurachase')}}</button>

                             {{-- <a href="{{asset('checkout/')}}" onclick="return addtocart()" class="btn-link"  >{{__('messages.continuepurachase')}}</a> --}}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            @else 
            <div class="container">
              <h4 class="text-center">{{__('messages.emptycart')}}</h3>
            </div>
            @endif
        </div>
    </div>

    <div class="clearfix"></div>

    @section('script')
        <script type="text/javascript">
        
            function changeprice(price,id) 
            {
                var qty = parseInt($('#itemqty'+id).val());
                
                document.querySelector("#price"+id).textContent =(price*qty);
                
                // var qty     =parseInt( $('#itemqty').val());
                // var qty     = parseInt( $('#itemqty'.item_id).val());
            }
           
            function addtocart() 
            {
                var item_id = $('#item_id').val();
                var price = $('#item_price').val();
                // var qty     =parseInt( $('#itemqty').val());
                var qty     = parseInt( $('#itemqty'.item_id).val());
                // console.log(qty);
                // var item_id = $('#itemid').val();
                // var price   = $('#itemprice').val();
                var Token   = $("input[name='_token']").val();
                $.ajax({
                    type: 'post',
                    url: '{{asset("/cart")}}',
                    data: {
                        _token  : Token,
                        item_id : item_id,
                        price   : price,
                        qty     : qty,
                    },
                    success: function (data) {
                        console.log(data);
                        $("#cart_text").html(data['cartcount']);
                        $("#total_text").html(data['total']);
                        // alert('Successflly added to Cart');
                        // toastr.success('Successflly added to Cart');
                    }
                    // ,
                    // error: function (data) {
                    //     alert('error when try to add product to cart');
                    // }
                });
            }

            function addtocart1(item_id,price) 
            {
                var qty     = parseInt( $('#itemqty'.item_id).val());
                // console.log(qty);
                if(qty>1)
               {
                
            var qty = 'f' ;
               
                var Token   = $("input[name='_token']").val();
                $.ajax({
                    type: 'post',
                    url: '{{asset("/cart")}}',
                    data: {
                        _token  : Token,
                        item_id : item_id,
                        price   : price,
                        qty     : qty,
                        // con     : 'f',
                    },
                    success: function (data) {
                        console.log(data);
                        $("#cart_text").html(data['cartcount']);
                        $("#total_text").html(data['total']);
                    //     alert('Successflly added to Cart');
                    //     toastr.success('Successflly added to Cart');
                    // }
                
                    // ,
                    // error: function (data) {
                    //     alert('error when try to add product to cart');
                    }
                });
            }}

            function addcart() 
            {
                var item_id =  $('#id').val();
                var price =  $('#price').val();
                var qty     = parseInt( $('#itemqty'.item_id).val());
                var Token   = $("input[name='_token']").val();
                $.ajax({
                    type: 'post',
                    url: '{{asset("/cart")}}',
                    data: {
                        _token  : Token,
                        item_id : item_id,
                        price   : price,
                        qty     : qty,
                    },
                    success: function (data) {
                        console.log(data);
                        $("#cart_text").html(data['cartcount']);
                        $("#total_text").html(data['total']);
                    //     alert('Successflly added to Cart');
                    //     toastr.success('Successflly added to Cart');
                    // },
                    // error: function (data) {
                    //     alert('error when try to add product to cart');
                    }
                });
            }
            
        </script>
    @stop


@endsection 