@extends('layout.master-client')
@section('title', 'Hóa đơn chi tiết')
@section('content')
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
                    <h1>Order detail</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="alert alert-default-info">
        {{-- <h3 class="text-center">Hóa đơn chi tiết sản phẩm</h3> --}}
    </div>
    <div class="col-lg-8 col-md-8 m-auto border border border-danger">
        {{-- <div class="d-flex">
            <div class="text-uppercase">
                <h2 class="font-weight-bolder">Sixteen <em style="color: #f33f3f; font-style: normal;">furniture</em></h2>
            </div>
        </div> --}}
        <div class="w-100">
            <h3 class="text-center">Hóa đơn mua hàng</h3>
            <div class="p-3 col-lg-10 m-auto">
                <div class="d-flex">
                    <div class="col-lg-6"><b>Tên khách hàng: </b>{{ $data->orderName }}</div>
                    <div class="col-lg-6"><b>Số điện thoại: </b> {{ $data->phone }}</div>
                </div>
                <div class="d-flex">
                    <div class="col-lg-6"><b>Email: </b> {{ $data->oderEmail }}</div>
                    <div class="col-lg-6"><b>Địa chỉ: </b> {{ $data->address }}</div>
                </div>
            </div>
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã id</th>
                        <th>Tên sản phẩm</th>
                        {{-- <th>Ảnh</th> --}}
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nameProduct }}</td>
                            {{-- <td><img src="{{ asset($item->avatar )}}" width="100px" alt=""></td> --}}
                            <td>{{ number_format($item->oddPricePrd) }}<sup>đ</sup></td>
                            <td>{{ $item->oddQuantityPrd }}</td>
                            <td>{{ number_format($item->oddPricePrd * $item->oddQuantityPrd) }}<sup>đ</sup></td>
                            <p hidden>{{ $total += $item->oddPricePrd * $item->oddQuantityPrd }}</p>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td colspan="4">Tổng tiền:</td>
                        <td colspan="1">{{ number_format($total) }}<sup>đ</sup></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection