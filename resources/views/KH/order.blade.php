@extends('layout.master-client')
@section('title', 'san pham')
@section('conten-title', 'san pham')
@section('content')
    <!-- search area -->
	<form action="{{route('client.shop')}}">
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
	<!-- end search area -->

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>List order</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if (session()->has('danger'))
            <div class="alert alert-danger">
                {{ session()->get('danger') }}
            </div>
        @endif
        {{-- @if ($errors->any())
        {{dd($errors)}}
    @endif --}}
    </div>
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        {{-- @if ($errors->any())
        {{dd($errors)}}
    @endif --}}
    </div>
    <div>
        <table class='table'>
            <thead>
                <tr>
                    <th>Mã id</th>
                    <th>Người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th colspan="2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_list as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->orderName }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->oderEmail }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->total }}</td>
                        <td>
                            <form action="{{ route('admin.orders.updateStatusOrder', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select disabled style="height: 30px" name="oderStatus" id="">
                                    <option {{ $item->oderStatus == 0 ? 'selected' : '' }} value="0">Đang xử lý
                                    </option>
                                    <option {{ $item->oderStatus == 1 ? 'selected' : '' }} value="1">Đang giao hàng
                                    </option>
                                    <option {{ $item->oderStatus == 2 ? 'selected' : '' }} value="2">Đã nhận hàng
                                    </option>
                                    <option {{ $item->oderStatus == 3 ? 'selected' : '' }} value="3">Hủy đơn hàng
                                    </option>
                                </select>
                                {{-- <button style="height: 30px" class="btn btn-dark "><i class="fa fa-redo"></i></button> --}}
                            </form>
                        </td>

                        <td>
                            <form action="{{ route('client.detail', $item->id) }}">
                                <button class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('client.updateStatusOrder', $item->id) }}">
                                @csrf
                                <button class="btn {{ $item->oderStatus == 3 ?'btn-success '  : 'btn-danger'}}"  >
                                    {{ $item->oderStatus == 3 ? 'Đặt lại đơn hàng' : 'Hủy đơn hàng'}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div>
        {{ $order_list->links() }}
    </div> --}}
    </div>
@endsection
