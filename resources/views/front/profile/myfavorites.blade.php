@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.myfavourites')}} @endsection
@section('content')

<div class="title_page">
    <div class="container">
        <ul>
            <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'المفضلة' : 'my favorites'}}</li>
        </ul>
    </div>
</div>

<div class="wishlist">
    <div class="container text-center">

        @if(count($favouriteitems)!=0)
        

        @foreach ($favouriteitems as $item)

            <?php
                $content  =  $item['title'];
                
                // $itemimage = DB::table('item_images')->where('item_id',$item->id)->value('image');
                // $itemfav = DB::table('favorite_items')->where('item_id',$item->id)->first(); 
                $session = session('locale') == 'en' ? 'Successflly added to Cart':'تم إضافة المنتج إلى السلة بنجاح';
                $errorr = session('locale') == 'en' ? 'Please log in first ':'من فضلك سجل الدخول اولا   ';
            ?>
            
            <div class="col-md-3 col-sm-6 ">
                <div class="project_1">
                    <img src="{{asset('users/images/'.$item['image'])}}" alt="">

                    @guest
                    @else
                    <div class="add_favorit">
                        {{-- <a type="button" onclick = "return addtowishlist({{$item['id']}},{{Auth()->user()->id}})"><i class="far fa-heart"></i></a> --}}

                        {!! Form::open(array('method' => 'POST','url' =>'/removefromwishlist/'.$item['id'])) !!}
                            <button style="background: none;border: none;" type="submit"><i class="fas fa-heart"></i></button>
                        {!! Form::close() !!}
                       
                    </div>
                    @endif 

                    <div class="details_project ">
                    <a href="{{asset('items/'.$item['id'])}}">{!! strlen($content) > 28 ? substr($content,0,28).'' : $content!!}</a>

                    @if($item['offer'] == 1)

                        <?php $discount = $item['price'] - $item['discountprice']  ?>

                        <h3>{{$discount}}{{__('messages.currancy')}}  <span>{{$item['price']}} {{__('messages.currancy')}}  </span></h3>
                        
 
                     @else 
                        <h3>{{$item['price']}} {{__('messages.currancy')}} </h3>
                     @endif
                    </div>

                    <div class="cart_project">
                        <a type="button" onclick = "return addtocart('{{$item['id']}}','{{ $item['discountprice'] == null ? $item['price'] : $item['discountprice']}}','1','{{$session}}','{{$errorr}}')">
                            <i class="fas fa-shopping-cart"></i>
                            <span>{{ session('locale') == 'ar' ? 'اضف للسلة' : 'add to card'}}</span>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
           
      @else
    <div class="products mb-5 ">
       <h3 class="container text-center">{{ $errormessage}}</h3>
    </div>
    
    @endif  

    </div>
</div><!-- END products -->




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

        </script>
    @stop

@endsection