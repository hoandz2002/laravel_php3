<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\GalleryImag;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')->where('statusCate', '=', 0)
            ->select('products.*', 'category_products.name', 'sizes.nameSize')->orderBy('products.id', 'ASC')->search()->Paginate(6);
        return view('admin.products.list', compact('products'));
    }
    public function create()
    {
        $cate = CategoryProduct::all()->where('statusCate', '=', 0);
        $sizes = Size::all()->where('statusSize', '=', 0);

        return view('admin.products.create', compact('cate', 'sizes'));
    }

    public function store(Request $request)
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $nextId = $statement[0]->Auto_increment;
        //
        $product = new Product();
        $product->fill($request->all());
        // 2. Kiểm tra file và lưu
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->productname . '_' . $avatarName;
            $product->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $product->avatar = 'https://banner2.cleanpng.com/20180625/req/kisspng-computer-icons-avatar-business-computer-software-user-avatar-5b3097fcae25c3.3909949015299112927133.jpg';
        }
        // 3. Lưu $product vào CSDL
        $files = [];
        if ($request->hasFile('filenames')) {
            foreach ($request->file('filenames') as $file) {

                $name = $file->getClientOriginalName();
                $file->move(public_path('images/GalleryProducts'), $name);
                $files[] = $name;
                $images = new GalleryImage();
                foreach ($files as $ok) {
                    $images->image_gallery = 'images/GalleryProducts/' . $ok;
                }

                $images->product_id = $nextId;
                $images->save();
            }
        }
        $product->save();
        session()->flash('success', 'Bạn đã thêm mới thành công!');
        return redirect()->route('products.list');
    }
    public function delete($product)
    {
        $data = Product::find($product);
        $data->delete();
        return redirect()->route('products.list');
    }
    public function edit(Product $product)
    {
        $cate = CategoryProduct::all()->where('statusCate', '=', 0);
        $sizes = Size::all()->where('statusSize', '=', 0);

        return view('admin.products.create', compact('product', 'cate', 'sizes'));
    }
    public function update(Request $request, $product)
    {

        $data = Product::find($product);
        $data->fill($request->all());
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->price . '_' . $avatarName;
            $data->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $data->avatar = $data->avatar;
        }
        $files = [];
        if ($request->hasFile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $images = new GalleryImage();
                $name = $file->getClientOriginalName();
                $file->move(public_path('images/GalleryProducts'), $name);
                $files[] = $name;
                foreach ($files as $ok) {
                    $images->image_gallery = 'images/GalleryProducts/' . $ok;
                }
                $images->product_id = $data->id;
                $images->save();
            }
        }
        $data->save();
        session()->flash('success', 'Bạn đã sửa thành công!');
        return redirect()->route('products.list');
    }
}
