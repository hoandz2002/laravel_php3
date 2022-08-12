@extends('layout.master-client')
@section('title', 'san pham')
@section('conten-title', 'san pham')
@section('content')

    <!--PreLoader-->
    {{-- <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div> --}}
    <!--PreLoader Ends-->


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
                        <h1>Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    
    <div class="cart-section mt-150 mb-150">
        <div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
          
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <p hidden>
                                            {{ $total += $item->quantity * $item->price }}

                                    </p>
                                    <tr class="table-body-row">
                                        <td class="product-remove">
                                            <form action="{{ route('client.deleteCart', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                {{-- <td class="product-remove"><a href="{{route('client.deleteCart',$item->id)}}"><i class="far fa-window-close"></i></a></td> --}}
                                                <button class="btn btn-danger"><i class="far fa-window-close"></i></button>
                                            </form>
                                        </td>
                                        {{-- <td class="product-remove"><a href="{{route('client.deleteCart',$item->id)}}"><i class="far fa-window-close"></i></a></td> --}}
                                        <td class="product-image"><img src="{{ asset($item->avatar) }}" alt=""></td>
                                        <td class="product-name">{{ $item->nameProduct }}</td>
                                        <td class="product-price">{{ $item->price }}</td>
                                        <td class="product-quantity"><input type="number" value="{{ $item->quantity }}"
                                                placeholder="0"></td>
                                        <td class="product-total">{{ $item->quantity * $item->price }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Subtotal: </strong></td>
                                    <td>{{ $total }}</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Shipping: </strong></td>
                                    <td>$45</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>$545</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="cart.html" class="boxed-btn">Update Cart</a>
                            <a href="{{route('client.checkout')}}" class="boxed-btn black">Check Out</a>
                        </div>
                    </div>

                    <div class="coupon-section">
                        <h3>Order detail</h3>
                        <div class="coupon-form-wrap">
                            <form action="{{route('client.showOrder')}}">
                                {{-- <p><input type="text" placeholder="Coupon"></p> --}}
                                {{-- <p><input type="button" value="Views"></p> --}}
                                <button class="btn btn-danger">View</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
