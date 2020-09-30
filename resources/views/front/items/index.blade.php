@extends('front.include.master')
@section('title')  {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale') == 'ar' ? 'كل المنتجات' : 'all products' }} 
@endsection

@section('content')


 <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="#">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}  /</a></li>
                <li>
                    
                    {{session('locale') == 'ar' ? 'كل المنتجات' : 'all products' }} 

                    
                </li>
            </ul>
        </div>
    </div>

    <div class="tages_sec">
        <div class="container">
            <ul>
            </ul>
        </div>
    </div>

@if(count($allitems)!=0)

    <div class="tt-filters-options">
        <div class="container">
            <h1 class="tt-title">
                 {{session('locale') == 'ar' ? 'كل المنتجات' : 'all products' }} 
             <span class="tt-title-total listing-total-js">({{$itemscount}})</span>
            </h1>

            {{-- <div class="tt-sort">
                <span>فرز بحسب</span>
            <select class="sort-position">
            <option value="manual"><a href="{{asset('items/')}}">الافتراضي</a></option>
                <option value="title-ascending"><a href="{{asset('items_filter/1')}}">الإسم من أ - ي</a></option>
                <option value="title-descending"><a href="{{asset('items_filter/2')}}">الإسم من ي - أ</a></option>
                <option value="created-ascending"><a href="{{asset('items_filter/3')}}">حسب السعر (منخفض > مرتفع)</a> </option>
                <option value="created-descending"><a href="{{asset('items_filter/4')}}">حسب السعر (مرتفع > منخفض) </a></option>
                <option value="price-ascending"><a href="{{asset('items_filter/0')}}">تقييم (مرتفع) </a></option>
                <option value="price-descending"><a href="{{asset('items_filter/0')}}">تقييم (منخفض) </a></option>
                <option value="best-selling" selected=""><a href="{{asset('items_filter/0')}}">النوع (أ - ي) </a></option>
                <option value="best-selling" selected=""><a href="{{asset('items_filter/0')}}">النوع (ي - أ)</a></option>
            </select>
            </div> --}}
        </div>
    </div>
    
    <div class="products">

        <div class="container text-center">
            @foreach ($allitems as $item)

            <?php
                $content  = session('locale') == 'en' ? $item->entitle : $item->artitle;
                $itemimage = DB::table('item_images')->where('item_id',$item->id)->value('image');
                $itemfav = DB::table('favorite_items')->where('item_id',$item->id)->first(); 
                $session = session('locale') == 'en' ? 'Successflly added to Cart':'تم إضافة المنتج إلى السلة بنجاح';
                $errorr = session('locale') == 'en' ? 'Please log in first ':'من فضلك سجل الدخول اولا   ';
            ?>
            
            <div class="col-md-3 col-sm-6 ">
                <div class="project_1">
                    <img src="{{asset('users/images/'.$itemimage)}}" alt="">

                    @guest
                    @else
                    <div class="add_favorit">
                        <a type="button" onclick = "return addtowishlist({{$item->id}},{{Auth()->user()->id}})"><i @if($itemfav)  class=" fas fa-heart" @else class=" far fa-heart" @endif></i></a>
                       
                    </div>
                     @endif
                    <div class="details_project ">
                    <a href="{{asset('items/'.$item->id)}}">{!! strlen($content) > 35 ? substr($content,0,35).'' : $content!!}</a>

                    @if($item->offer == 1)

                        <?php $discount = $item->price - $item->discountprice  ?>

                        <h3>{{$discount}}{{__('messages.currancy')}}  <span>{{$item->price}} {{__('messages.currancy')}}  </span></h3>
                        
 
                     @else 
                        <h3>{{$item->price}} {{__('messages.currancy')}} </h3>
                     @endif
                    </div>

                    <div class="cart_project">
                        <a style="padding: 10px 50px;" type="button" onclick = "return addtocart('{{$item->id}}','{{ $item->discountprice == null ? $item->price : $item->discountprice}}','1','{{$session}}','{{$errorr}}')">
                            <i class="fas fa-shopping-basket"></i>
                            <span  >{{ session('locale') == 'ar' ? 'اضف للسلة' : 'add to card'}}</span>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
           

        </div>
    </div><!-- END products -->

@else
    <div class="products mb-5 ">
       <h3 class="container text-center">{{ session('locale') == 'ar' ? 'لا يوجد منتجات ' : 'Does not exist any products'}}</h3>
    </div>
    
@endif

     @section('script')
        <script type="text/javascript">
            function addtocart(item_id,price,qty,session,errorr) 
            {
                var Token = $("input[name='_token']").val();
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
                        // console.log(data);
                        $("#cart_text").html(data['cartcount']);
                        $("#total_text").html(data['total']);
                        alertify.success(session);
                        // alert('Successflly added to Cart');
                        //toastr.success('Successflly added to Cart');
                    },
                    error: function (data) {
                        alertify.error(errorr);
                        
                        // alert('error when try to add product to cart');
                    }
                });
            }

            function addtowishlist(item_id,user_id) 
            {
                var Token = $("input[name='_token']").val();
                $.ajax({
                    type: 'post',
                    url: '{{asset("/addtowishlist")}}',
                    data: {
                        _token  : Token,
                        item_id : item_id,
                        user_id : user_id,
                    },
                    success: function (data) {
                        console.log(data);
                        $("#wishlist-text").html(data['count']);
                        alertify.success(data['message']);
                        // alert(data['message']);
                        
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