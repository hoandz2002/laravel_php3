@extends('layout.master-client')
@section('title','san pham')
@section('conten-title','san pham')
@section('content')

    <!-- search area -->
 <form action="">
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" name="search" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </form>
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
                                <li data-filter=".prd{{ $data->id }}">
                                    {{ $data->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row product-lists">
                @foreach ($products as $item)
                    <div class="col-lg-4 col-md-6 text-center prd{{ $item->category_id }}">
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
 {{-- <!-- jquery -->
 <script src="{{asset(' assets/js/jquery-1.11.3.min.js')}}"></script>
 <!-- bootstrap -->
 <script src="{{asset(' assets/bootstrap/js/bootstrap.min.js')}}"></script>
 <!-- count down -->
 <script src="{{asset(' assets/js/jquery.countdown.js')}}"></script>
 <!-- isotope -->
 <script src="{{asset(' assets/js/jquery.isotope-3.0.6.min.js')}}"></script>
 <!-- waypoints -->
 <script src="{{asset(' assets/js/waypoints.js')}}"></script>
 <!-- owl carousel -->
 <script src="{{asset(' assets/js/owl.carousel.min.js')}}"></script>
 <!-- magnific popup -->
 <script src="{{asset(' assets/js/jquery.magnific-popup.min.js')}}"></script>
 <!-- mean menu -->
 <script src="{{asset(' assets/js/jquery.meanmenu.min.js')}}"></script>
 <!-- sticker js -->
 <script src="{{asset(' assets/js/sticker.js')}}"></script>
 <!-- main js -->
 <script src="{{asset(' assets/js/main.js')}}"></script> --}}

 @endsection

    <!-- footer -->
   