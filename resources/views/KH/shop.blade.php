@extends('layout.master-client')
@section('title','san pham')
@section('conten-title','san pham')
@section('content')

    <!--PreLoader-->
    {{-- <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div> --}}
    <!--PreLoader Ends-->

    <!-- header -->
    {{-- <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="index.html">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li class="current-list-item"><a href="">Home</a>
                                    <ul class="sub-menu">
                                        <li><a href="">Static Home</a></li>
                                        <li><a href="index_2.html">Slider Home</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('client.about') }}">About</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="404.html">404 page</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="checkout.html">Check Out</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="news.html">News</a></li>
                                        <li><a href="shop.html">Shop</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('client.new') }}">News</a>
                                    <ul class="sub-menu">
                                        <li><a href="news.html">News</a></li>
                                        <li><a href="single-news.html">Single News</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('client.contact') }}">Contact</a></li>
                                <li><a href="{{ route('client.shop') }}">Shop</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop.html">Shop</a></li>
                                        <li><a href="checkout.html">Check Out</a></li>
                                        <li><a href="single-product.html">Single Product</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="cart.html"><i
                                                class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon" href="#"><i
                                                class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search arewa -->

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($cate as $data)
                                <li data-filter=".L{{ $data->id }}">{{ $data->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row product-lists">
                @foreach ($products as $item)
                    <div class="col-lg-4 col-md-6 text-center L{{ $item->category_id }}">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{route('client.single',$item->id)}}"><img
                                        src="{{asset($item->avatar)}}"
                                        alt=""></a>
                            </div>
                            <h3>{{ $item->nameProduct }}</h3>
                            <p style="color: red" class="product-price"><span style="color: gray">each product</span> {{ number_format($item->price)}}<sup>đ</sup> </p>
                            <a href="{{ route('client.cart') }}" class="cart-btn"><i
                                    class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>

                    </div>
                @endforeach
            </div>



            {{-- <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div style="margin: 0 auto;">{{ $products->links() }}</div>

        </div>
    </div>
    <!-- end products -->

 @endsection

    <!-- footer -->
   