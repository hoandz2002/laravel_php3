@extends('layout.master')
@section('title', 'Thêm mới sản phẩm')
@section('content-title', 'Thê mới sản phẩm')
@section('content')

    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST"
        enctype="multipart/form-data">
        {{ isset($product) ? method_field('PUT') : '' }}

        @csrf
        <div cclass="form-group">
            <label for="">Tên sản phẩm</label>
            <input type="text" name="nameProduct" value="{{ isset($product) ? $product->nameProduct : old('nameProduct') }}"
                id="" class="form-control">
                @if ($errors->has('nameProduct'))
                <p class="text-danger">{{ $errors->first('nameProduct') }}</p>
            @endif
        </div>
      
        <div class="form-group">
            <label for="">Mô tả</label>
            <input class="form-control" type="text" name="description"
                value="{{ isset($product) ? $product->description : old('description') }}" id="">
                @if ($errors->has('description'))
                <p class="text-danger">{{ $errors->first('description') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="">Giá sản phẩm</label>
            <input class="form-control" type="text" name="price"
                value="{{ isset($product) ? $product->price : old('price') }}" id="">
                @if ($errors->has('price'))
                <p class="text-danger">{{ $errors->first('price') }}</p>
            @endif
        </div>
      
        <div class="form-group">
            <label for="">Avatar</label><br>
            <td><img src="{{ isset($product) ? asset($product->avatar) :''}}" alt="" width="100"></td>
            <br> <br>
            <input class="form-control" type="file" name="avatar"
                value="{{ isset($product) ? $product->price : old('price') }}" id="">
                @if (session()->has('error'))
                <p class="text-danger">{{ session()->get('error') }}</p>
            @endif
        </div>
        <div class="col-md-6">
            <label class="form-label">Thư viện ảnh</label> <br>
            <input type="file" name="filenames[]" multiple class="form-control"
                placeholder="Chọn ảnh sản phẩm" />
        </div>
        <div class="form-group">
            <label for="">Danh mục dản phẩm</label>
            <select class="w-100 p-2" name="category_id" id="">
                <option value="">chọn danh mục sản phẩm</option>
                @foreach ($cate as $item)
                    <option value="{{ $item->id }}"
                        {{ isset($data) && $data->category_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
            <p class="text-danger">{{ $errors->first('category_id') }}</p>
        @endif
        </div>
        <div class="form-group">
            <label for="">Size</label>
            {{-- <input class="form-control" type="text" name="size_id"
                value="{{ isset($user) ? $product->size_id : old('size_id') }}" id=""> --}}
            <select class="w-100 p-2" name="size_id" id="">
                <option value="">Chọn kích cỡ sản phẩm</option>
                @foreach ($sizes as $item)
                    <option value="{{ $item->id }}"
                        {{ isset($data) && $data->size_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nameSize }}</option>
                @endforeach
            </select>
            @if ($errors->has('size_id'))
            <p class="text-danger">{{ $errors->first('size_id') }}</p>
        @endif
        </div>

        <div class="form-group">
            <label for="">Trạng thái</label>
            <input type="radio" name="statusPrd" value="0" {{-- {{ $data->statusPrd === 0 ? 'checked' : '' }} --}} /> Hiển thị
            <input type="radio" name="statusPrd" value="1" {{-- {{ $data->statusPrd === 1 ? 'checked' : '' }} --}} /> Ẩn
        </div>
        <button class="btn btn-success">
            {{ isset($product) ? 'Update' : 'Create' }}
        </button>
        <button class="btn btn-danger">nhập lại</button>
    </form>
@endsection
