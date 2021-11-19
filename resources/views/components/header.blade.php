<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> thegioilinhkienb@dev.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="/Eshopper/images/home/logo.png" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <style>
                            .nav navbar-nav li{
                                cursor : pointer;
                            }
                            #count_cart {
                                padding: 3px;
                                font-size: 13px;
                                margin-left : 3px;
                                width: 30px;
                                height: 30px;
                                color: white;
                                background-color : red;
                                border-radius: 50%;
                            }
                        </style>
                        <ul class="nav navbar-nav">
                            @if(Session::get('customer_id') || Session::get('admin_id'))
                            <li><a href="{{ route('customer.profile') }}"><i class="fa fa-user"></i> Thông tin cá nhân</a></li>
                            <li><a style="cursor: pointer" class="showWishlist" data-id="{{ Session::get('customer_id') }}"><i class="fa fa-star"></i> Yêu thích</a></li>
                            @endif
                            <li><a href="{{ route('checkout.index') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            @if(Session::get('cart'))
                                @php
                                    $count_cart = 0;
                                @endphp
                                @foreach (Session::get('cart') as $key => $ncc)
                                    @foreach ($ncc as $key1 => $item)
                                        @if($key1 != 0)
                                            @php
                                                $count_cart = $count_cart + 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                                <li>
                                    <a href="{{ route('product.showCart') }}" id="show_cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng<span id="count_cart">{{ $count_cart }}<span></a>
                                    <div id="hover_cart" style="display: none; width: 200px; height: 150px; background-color : red;">

                                    </div>
                                </li>
                            @else
                            <li>
                                <a href="{{ route('product.showCart') }}" id="show_cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng<span id="count_cart" style="display: none"><span></a>
                                <div id="hover_cart" style="display: none; width: 200px; height: 150px; background-color : red;">

                                </div>
                            </li>
                            @endif
                            <li>
                                @if(Session::get('customer_id') || Session::get('admin_id'))
                                    <a href="{{ route('customer.logout') }}"><i class="fa fa-lock"></i> Đăng xuất</a>
                                @else
                                    <!-- <a href="{{ route('customer.index') }}"><i class="fa fa-lock"></i> Đăng nhập</a> -->

                                    <a href="" class="modalLogin"><i class="fa fa-lock"></i> Đăng nhập</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('trangchu') }}" class="active">Trang chủ</a></li>
                            <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($cateposts as $item)
                                    <li><a href="{{ route('posts.index',['slug' => $item->dmbv_slug]) }}">{{ $item->dmbv_ten }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form action="{{ route('search') }}" method="get" id="search-form">
                        @csrf
                        <input id="input-search" type="text" name="name" placeholder="Search"/>

                    </form>

                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
