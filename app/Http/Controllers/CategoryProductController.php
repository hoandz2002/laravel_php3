<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryProductRequest;
use App\Models\CategoryProduct;
use App\Models\CategotyProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categoryProducts = CategoryProduct::select('id','name','statusCate')
        ->Paginate(6);
        return view('admin.category-product.list', ['list_cate' => $categoryProducts]);
    }
    public function create()
    {
        return view('admin.category-product.create');
    }
    public function store(Request $request)
    {
        $cate=new CategoryProduct();

        $cate->fill($request->all());

        $cate->save();
        return redirect()->route('catepr.list');
    }
    public function edit(CategoryProduct $cate)
    {
        return view('admin.category-product.create',[
            'cate'=> $cate,
        ]);
    }
    public function update(Request $request,CategoryProduct $cate)
    {
        $catenew=CategoryProduct::find($cate->id);
        // dd($request->all());
        $catenew->name = $request->name;
        $request->statusCate ? $catenew->statusCate = $request->statusCate : $catenew->statusCate = $catenew->statusCate;

        $catenew->save();
        return redirect()->route('catepr.list');

    }
    public function delete(CategoryProduct $cate)
    {
        $data=CategoryProduct::find($cate);
        $data->delete();
        return redirect()->route('catepr.list');

    }
    public function updateStatus($cate)
    {
            $updateStatus = CategoryProduct::find($cate);
            if($updateStatus->statusCate === 0){
                $updateStatus->statusCate = 1;
            }else {
                $updateStatus->statusCate = 0;
            }
            $updateStatus->save();
            session()->flash('success', 'Bạn đã cập nhật trạng thái thành công!');
            return redirect()->route('catepr.list');
            // return redirect()->back();
    }
   
}
