<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('users/images/logo.png')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('users/fontawesome/css/fontawesome-all.min.css')}}">
    @if(session('locale') == 'en')
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css">
    @else
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.rtl.min.css">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/bootstrap-a.min.css')}}">
    <link rel="stylesheet" href="{{asset('users/css/hover-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/swiper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/knockout-file-bindings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/prettyPhoto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('users/css/responsive.css')}}">
</head>
<body id="scroll-me-all-night-long">
    
    <ul class="call-now list-unstyled"><li class="whatsapp"><a target="_blank" href="https://api.whatsapp.com/send?phone=+966559811011" <="" a=""><i class="fab fa-whatsapp"></i></a></li></ul>
    
    <a id="button">
        <img src="{{asset('users/images/mouse.svg')}}" alt="" />
    </a>

<div class="wap">
<?php
    $setting = DB::table('settings')->first();
?>
    <header  style="border-bottom: rgb(80, 79, 79) 2px solid;background-color:#fafafa">
        <div class="container ">
            <div class="row">
                <div class="col-md-3">
                    {{-- <div class="logo">
                        <img src="{{asset('users/images/logo.png')}}" alt="">
                    </div> --}}
                </div>

                <div class="col-md-9">
                    {{-- <div class="top_head">
                        <div class="col-md-12">
                            <div class="contact_head">
                                <div class="col-md-4">
                                    <div class="icon_foot">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>

                                    <div class="fl_lef">
                                        <h3>{{ session('locale') == 'ar' ? 'الرياض' : 'Riyadh'}}</h3>
                                        <h3>{{ session('locale') == 'ar' ? 'المملكة العربية السعودية' : 'Saudi Arabia'}}</h3>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="icon_foot">
                                        <i class="fas fa-phone"></i>
                                    </div>

                                    <div class="fl_lef">
                                        <h3>0556390096</h3>
                                        <h3>0556390096</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="cart">
                                    <div class="icon_foot">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>

                                    <div class="fl_lef">
                                        <a href="{{asset('cart')}}">
                                            <h3 id="cart_text">@if(session('shopping_cart')) {{session('shopping_cart')['cartcount']}} @else 0 @endif {{ session('locale') == 'ar' ? 'منتجات' : 'products'}}</h3>
                                            <h3 id="total_text">@if(session('shopping_cart')) {{session('shopping_cart')['total'] }} @else 0 @endif {{ session('locale') == 'ar' ? 'ر.س' : 'SAR'}}</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="menu_lang">
                        <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0%">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle toggle-menu menu-left push-body " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar top-bar"></span>
                                    <span class="icon-bar middle-bar"></span>
                                    <span class="icon-bar bottom-bar"></span>
                                </button>
                            </div>
                                                                                        
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav text-white">
                                    <li><a class="active" href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}}</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{session('locale')=='ar' ? 'الاقسام' : 'categories'}} <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            

                                            @foreach($footercats as $cat)
                            <li><a href="{{asset('/categories/'.$cat->id)}}">{{ session('locale') == 'en' ? $cat->encategory : $cat->arcategory}}</a></li>
                                            @endforeach

                                        </ul>
                                    </li>
                                    <li><a href="{{asset('/items')}}"> {{session('locale')=='ar' ? 'المنتجات' : 'products'}}</a></li>
                                    <li><a href="{{asset('/mostsold')}}"> {{session('locale')=='ar' ? 'الاكثر بيعا' : 'mostsold'}}</a></li>
                                    <li><a href="{{asset('contactus')}}"> {{session('locale')=='ar' ? 'تواصل معنا' : 'contact us'}}</a></li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </nav>

                        <div class="lang_account">
                            <div class="lang_menu">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        @if(session('locale')=='ar') <img src="{{asset('users/images/ar.png')}}" alt="">
                                        @elseif(session('locale')=='en')
                                        <img src="{{asset('users/images/en.png')}}" alt="">
                                        @endif {{session('locale')=='ar' ? 'اللغة' : 'language'}} <i class="fas fa-sort-down"></i> </a>
                                    <ul class="dropdown-menu">
                                        <li class="login_menu"> <a href="{{asset('locale/ar')}}"  ><img src="{{asset('users/images/ar.png')}}" alt=""> عربى</a></li>
                                        <li class="register_menu" ><a href="{{asset('locale/en')}}" ><img src="{{asset('users/images/en.png')}}" alt=""> English </a></li>
                                    </ul>
                                </li>
                            </div>

                            <div class="profile_menu">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-alt"></i>  {{session('locale')=='ar' ? 'حسابى' : 'myaccount'}}  <i class="fas fa-sort-down"></i> </a>
                                    <ul class="dropdown-menu">
                                @guest
                                    <li><a href="{{asset('/login')}}">{{session('locale')=='ar' ? 'تسجيل الدخول' : 'login'}} </a></li>
                                    <li><a href="{{asset('/register')}}">{{session('locale')=='ar' ? 'تسجيل جديد' : 'register'}} </a></li>
                                @else 
                                    <li><a href="{{asset('/profile')}}">حسابي </a></li>
                                    <li><a href="{{asset('/myorders')}}"> طلباتى </a></li>
                                    <li><a href="{{asset('/mybills')}}"> فواتير</a></li>
                                    <li><a href="{{asset('/myfavorites')}}"> المفضلة </a></li>
                                    <li><a href="{{asset('/mynotification')}}">الإشعارات </a></li>
                                    <li>
                                        <a href="{{asset('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> {{__('messages.logout')}} </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @endif
                                    </ul>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </header><!--End header-->

    <div class="notify-example">
        @if(session('success') || session('error'))
            <div class="alert alert-{{session('success') ? 'success' : 'danger'}} fade in text-center">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> {{session('success') ? session('success') : session('error')}} </strong>
            </div>
        @endif
    </div>
    
<div class="clearfix"></div>

 @yield('content')

  <footer>
        <div class="row">
            <div class="col-md-4 col-sm-12 text-center">
                <div class="about_app">
                    <img src="{{asset('users/images/logo_footer.png')}}" alt="">
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-xs-6">
                <div class="list_menu">
                    <h1>{{session('locale')=='ar' ? 'الاكثر بحثآ' : 'most searched'}}</h1>
                    <ul>
                        <?php 
                  $cats  = DB::table('categories')->paginate(4); 
                  
                        ?>
                        @foreach($cats as $cat)
                        <li><a href="{{asset('/categories/'.$cat->id)}}">{{ session('locale') == 'en' ? $cat->encategory : $cat->arcategory}}</a></li>
                        
                        @endforeach
                        <!--<li><a href="#">{{session('locale')=='ar' ? 'ورق' : 'papers'}}</a></li>-->
                        <!--<li><a href="#">{{session('locale')=='ar' ? 'مناديل' : 'tissues'}}</a></li>-->
                        <!--<li><a href="#">{{session('locale')=='ar' ? 'بلاستيك' : 'plastic'}}</a></li>-->
                        <!--<li><a href="#">{{session('locale')=='ar' ? 'بشرة' : 'skin'}}</a></li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <div class="list_menu">
                    <h1>{{session('locale')=='ar' ? 'معلومات ' : 'information'}}</h1>
                    <ul>
                    <li><a href="{{asset('aboutus/')}}">{{session('locale')=='ar' ? 'من نحن' : 'who are we'}}</a></li>
                        <li><a href="{{asset('shipping/')}}">{{session('locale')=='ar' ? 'معلومات الشحن والتوصيل' : 'Shipping and delivery information
'}}</a></li>
                        <li><a href="{{asset('privacy/')}}">{{session('locale')=='ar' ? 'الخصوصية' : 'privacy'}}</a></li>
                        <li><a href="{{asset('policy/')}}">{{session('locale')=='ar' ? 'شروط الاستخدام' : 'conditions'}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <div class="list_menu">
                    <h1>{{session('locale')=='ar' ? 'حسابى' : 'my account'}}</h1>
                    <ul>
                        <li><a href="{{asset('profile/')}}">{{session('locale')=='ar' ? 'حسابى' : 'my account'}}</a></li>
                        <li><a href="{{asset('/myorders')}}">{{session('locale')=='ar' ? 'طلباتى' : 'my orders'}}</a></li>
                        <li><a href="{{asset('/myfavorites')}}">{{session('locale')=='ar' ? 'قائمة رغباتى' : 'my favourite list'}}</a></li>
                        <!--<li><a href="#">{{session('locale')=='ar' ? 'القائمة البريدية' : 'email list'}}</a></li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <div class="list_menu">
                    <h1>{{session('locale')=='ar' ? 'خدمة العملاء' : 'customer services'}}</h1>
                    <ul>
                        <li><a href="{{asset('contactus/')}}">{{session('locale')=='ar' ? 'اتصل بنا' : 'contact us'}}</a></li>
                    <li><a href="{{asset('myorders/')}}">{{session('locale')=='ar' ? 'ارجاع الطلب' : 'return order'}}</a></li>
                        <li><a href="#">{{session('locale')=='ar' ? 'خريطة الموقع' : 'site map'}}</a></li>
                        <li><a href="{{asset('bankaccounts/')}}">{{session('locale')=='ar' ? 'الحسابات البنكية' : 'bank accounts'}}</a></li>
                    </ul>
                </div>
            </div>
            
        </div>

        <div class="copyright">
            <p>{{session('locale')=='ar' ? '© جميع الحقوق محفوظة 2020' : '© All Rights Reserved 2020
'}}</p>
            <a href="https://eltamiuz.com/">{{session('locale')=='ar' ? 'تصميم وبرمجة: مؤسسة التميز العربى' : 'Design and programming: Arab Excellence Foundation'}}</a>
        </div>

    </footer>

</div><!--End Wap-->

<script src="{{asset('users/js/wow.min.js')}}"></script>
<script src="{{asset('users/js/swiper.min.js')}}"></script>
<script src="{{asset('users/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('users/js/jquery.min.js')}}"></script>
<script src="{{asset('users/js/bootstrap.min.js')}}"></script>
<script src="{{asset('users/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('users/js/countdown.js')}}"></script>
<script src="{{asset('users/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>

@yield('script')
</body>
</html>