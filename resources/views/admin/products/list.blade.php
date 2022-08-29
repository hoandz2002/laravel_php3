@extends('layout.master')

@section('title', 'Quản lý sản phẩm')

@section('content-title', 'Quản lý nsản phẩm')

@section('content')
    <div>
        <a href="{{ route('products.create') }}">
            <button class='btn btn-success'>Tạo mới</button>
        </a>
    </div>
    <div class="d-inline-flex">
        <form action="" class="form-group d-block">
            <input type="text" class="form-control mr-1 d-inline-block"  name="search" placeholder="Tìm kiếm tên sản phẩm">
            <button type="submit" class="btn btn-primary w-50">Tìm kiếm</button>
        </form>
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Danh mục sản phẩm</th>
                <th>Kích cỡ</th>
                <th>Trạng thái</th>
                <th>Avatar</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->nameProduct }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->nameSize}}</td>
                    <td>{{ $product->statusPrd == 0 ? 'còn hàng' : 'hết hàng' }}</td>
                    <td><img src="{{ asset($product->avatar) }}" alt="" width="100"></td>
                    <td>
                        <a href="{{route('products.edit', $product->id)}}">
                            <button class='btn btn-warning'>Sửa</button>
                        </a>
                        <form action="{{ route('products.delete', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  class='btn btn-danger' onclick="return confirm('Bạn có chắc chắn muốn xóa')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
@endsection
