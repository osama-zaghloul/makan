@extends('front.include.master')
@section('title')  {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale') == 'en' ? $showitem->entitle : $showitem->artitle }} @endsection
@section('content')

<div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}/</a></li>
                <li><a href="#"> <a href="{{asset('/categories/'.$catinfo->id)}}"> 
                    @if(session('locale')=='ar') {{$catinfo->arcategory}}@else {{$catinfo->encategory}}@endif/</a></li>
                <li>@if(session('locale')=='ar') {{$showitem->artitle}}@else {{$showitem->entitle}}@endif</li>
            </ul>
        </div>
    </div>

   <div class="product-view">
       <div class="container">
           <div class="row">
               <div class="col-md-5">
                   <div class="slider_produ">
                        <!-- Swiper -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($adimages as $adimages)
                                    
                                
                                <div class="swiper-slide">
                                    <img src="{{asset('users/images/'.$adimages->image)}}" alt="{{$showitem->entitle}}">
                                </div>
                                @endforeach
                               
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                   </div>
               </div>

            <?php
                $content  = session('locale') == 'en' ? $showitem->entitle : $showitem->artitle;
                 $desc  = session('locale') == 'en' ? strip_tags($showitem->endesc) : strip_tags($showitem->ardesc);
                $discount = $showitem->price - $showitem->discountprice;
                 $session = session('locale') == 'en' ? 'Successflly added to Cart':'تم إضافة المنتج إلى السلة بنجاح';
                $errorr = session('locale') == 'en' ? 'Please log in first ':'من فضلك سجل الدخول اولا   ';
            ?>

               <div class="col-md-7">
                    <div class="details_product">
                        <h1>@if(session('locale')=='ar') {{$showitem->artitle}}@else {{$showitem->entitle}}@endif</h1>
                        <p> {{$desc}}</p>
                        <ul>
                            <li>{{session('locale')=='ar' ? 'حالة التوفر ' : 'available count'}}:<span> {{$showitem->count}}</span></li>

                            <li>{{session('locale')=='ar' ? 'النوع' : 'type'}} :<span> <a href="{{asset('/subcategories/'.$subcatinfo->id)}}"> 
                            @if(session('locale')=='ar') {{$subcatinfo->artitle}}@else  {{$subcatinfo->entitle}}@endif </a></span></li>
                        </ul>
                        @if($showitem->offer == 1)

                    <h3>{{$showitem->discountprice}} {{session('locale')=='ar' ? 'ر.س' : 'SAR'}}  <span>{{$showitem->price}} {{session('locale')=='ar' ? 'ر.س' : 'SAR'}}</span></h3>

                        @else 
                        <h3>{{$showitem->price}} {{session('locale')=='ar' ? 'ر.س' : 'SAR'}} </h3>
                        @endif

                        <div class="quantity">
                            <input type="number" id="itemqty" class="input-text qty text" step="1" min="1" max="{{$showitem->count}}" name="quantity" value="1" title="Qty" />
                        </div>

                        <input type="hidden" id="itemprice" value="{{ $showitem->discountprice == null ? $showitem->price : $discount}}">
                           <input type="hidden" id="itemid"    value="{{$showitem->id}}">

                        <div class="ca_wi">
                            <div class="cart_project">
                                <a type="button" onclick = "return addtocart('{{$session}}','{{$errorr}}')">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>{{session('locale')=='ar' ? 'اضف للسلة' : 'add to card'}}</span>
                                </a>
                            </div>
                        </div>

                    </div>
               </div>

           </div>
       </div>
   </div>

   <div class="latest_products">
        <div class="container text-center">
            <div class="title">
                <h1>منتجات مشابهه</h1>
                <img src="images/title.png" alt="">
            </div>
            <div class="swiper-container3">
                <div class="swiper-wrapper">
                    @foreach ($similatitems as $item)
               <?php
                $content  = session('locale') == 'en' ? $item->entitle : $item->artitle;
                $itemimage = DB::table('item_images')->where('item_id',$item->id)->value('image'); 
                $discount = $item->price - $item->discountprice;
               
               ?>
                   
                    <div class="swiper-slide">
                        <div class="last_prod">
                            <img src="{{asset('users/images/'.$itemimage)}}" alt="">
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                            <div class="details_product">
                                <a href="{{asset('items/'.$item->id)}}">{!! strlen($content) > 30 ? substr($content,0,30).'....' : $content!!}</a>
                                @if($item->offer == 1)
                                <h2>{{$showitem->discountprice}} {{session('locale')=='ar' ? 'ر.س' : 'SAR'}}  <span>{{$item->price}} {{session('locale')=='ar' ? 'ر.س' : 'SAR'}}</span></h2>

                                @else 
                                 <h2>{{$item->price}} {{session('locale')=='ar' ? 'ر.س' : 'SAR'}} </h2>
                        @endif
                            </div>
                        </div>
                    </div>
                     @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>
    </div><!-- END latest_products -->

    @section('script')
        <script type="text/javascript">
           
            function addtocart(session,errorr) 
            {
                var qty     = $('#itemqty').val();
                var item_id = $('#itemid').val();
                var price   = $('#itemprice').val();
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
                         alertify.success(session);
                    },
                    error: function (data) {
                         alertify.error(errorr);
                    }
                });
            }

            function addcart(item_id,price,qty) 
            {
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
                        alert('Successflly added to Cart');
                        //toastr.success('Successflly added to Cart');
                    },
                    error: function (data) {
                        alert('error when try to add product to cart');
                    }
                });
            }
            
        </script>
    @stop

@endsection