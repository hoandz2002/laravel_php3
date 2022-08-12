@extends('layout.master-client')
@section('title', 'san pham')
@section('conten-title', 'san pham')
@section('content')

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
                        <p>See more Details</p>
                        <h1>Single Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset($dataProduct->avatar) }}" alt="">
                    </div>
                </div>
                <form action="">

                </form>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{ $dataProduct->nameProduct }}</h3>
                        <p class="single-product-pricing"><span>Each product</span> {{ $dataProduct->price }}</p>
                        <p>{{ $dataProduct->description }}</p>
                        <div class="single-product-form">
                            <form action="{{ route('client.storeCart') }}" method="POST">
                                @csrf
                                <input hidden type="text" value="{{ $dataProduct->id }}" name="productId" id="">
                                <input hidden type="text" value="{{ Auth::user()?Auth::user()->id : '' }}" name="userId" id="">
                                <input hidden type="text" value="{{ $dataProduct->price }}" name="price"
                                    id="">
                                <input type="number" name="quantity" min="1" value="1" placeholder="0"> <br>
                                <button class="btn btn-warning p-2" style="border-radius: 20px;font-weight: bold">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <br> <br>
                            </form>
                            <p><strong>Categories: </strong>
                                @foreach ($cate as $data)
                                    @if ($data->id == $dataProduct->category_id)
                                        {{ $data->name }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->
    <div style="margin-left: 400px;margin-bottom: 20px; " class="comment">
		<h5 style="font-weight: bold;color: green">Commnet</h5>
	
        @if (Auth::user())
        <form action="{{ route('client.storeComment') }}" method="POST">
			@csrf
            <input hidden type="text" name="user_id" value="{{ Auth::id() }}" id="">
            <input hidden type="text" name="product_id" value="{{$dataProduct->id}}" id="">
            <img style="border-radius: 5px" src="{{asset(Auth::user()->avatar)}}"
                width="50px" alt="">
            <input type="text" style="width: 500px;height: 50px;border-radius: 5px;border: solid 1px gray;font-size: 20px" name="content"
                placeholder="Viết bình luận" id="">
            <button class="btn btn-success" style="height: 50px">Submit</button>
        </form>
        @else
        <p style="color: gray">Vui lòng đăng nhập để sử dụng tính năng này</p>
        @endif

    
		@foreach ($comment as $data )
		<div style="margin-top: 40px;width: 100%;display: flex;float: left"> 
		
			<div style="width: 50px">
			   <img src="{{asset($data->avatar)}}"
			width="50px" alt="">
		   </div>
		   <div style="margin-left:20px"> 
			   <span style="font-weight:bold">{{$data->name}}</span><br>
		   <span>{{$data->content}}</span> <br>
		   <span style="font-size: 13px"><a href="#">thích</a></span>
		   <span style="font-size: 13px;margin-left: 5px"><a href="#">phản hồi</a></span>
		   <span style="font-size: 13px;color: gray;margin-left: 5px">{{$data->dateComment}}</span>
		   </div>
	   </div>
		@endforeach
    </div>
	
    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
						<hr>
                        <h3><span class="orange-text">Related</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($productCate as $data)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="single-product.html"><img src="{{ asset($data->avatar) }}" alt=""></a>
                            </div>
                            <h3>{{ $data->nameProduct }}</h3>
                            <p style="color: red" class="product-price"><span style="color: gray">Each product</span> {{number_format($data->price)}}<sup>đ</sup> </p>
                            <a href="" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- end more products -->
@endsection
