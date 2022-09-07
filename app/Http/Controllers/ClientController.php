<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\UserRequest;
use App\Models\Cart;
use App\Models\CategoryProduct;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {

        $product = Product::select('nameProduct', 'price', 'avatar')->skip(0)->take(3)->get();

        return view('KH.index', [
            'product' => $product
        ]);
    }
    public function contact()
    {
        return view('KH.contact');
    }
    public function storeContact(ContactRequest $request)
    {
        $contact = new Contact();

        $contact->fill($request->all());
        $contact->save();
        session()->flash('success', 'bạn đã gửi thành công');
        return redirect()->route('client.contact');
    }
    public function shop()
    {
        $cate = CategoryProduct::all();
        $sizes = Size::all();
        $products = Product::Select('id', 'nameProduct', 'price', 'avatar')->search()->Paginate(6);
        return view('KH.shop', compact('products', 'cate', 'sizes'));
    }

    public function about()
    {
        return view('KH.about');
    }
    public function new()
    {
        return view('KH.news');
    }
    public function cart(Request $request)
    {

        $total = 0;
        $products = Cart::select('carts.*', 'products.nameProduct', 'products.avatar', 'products.price')->join('products', 'carts.productId', '=', 'products.id')->where('userId', '=', Auth::user()->id)->get();
        // dd($products);
        return view('KH.cart', compact('products', 'total'));
    }
    public function storeCart(Request $request)
    {
        $product = new Cart();
        $product->fill($request->all());
        //

        $cartAllId = DB::table('carts')->where('carts.userId', '=', Auth::user()->id)->get();
        foreach ($cartAllId as $data) {
            if ($data->productId == $request->productId) {
                $cartId = DB::table('carts')->where('carts.userId', '=', Auth::user()->id)->where('carts.productId', '=', $request->productId)->get();
                $number = $data->quantity + $request->quantity;
                // \dd($number);
                $id = $cartId->pluck('id'); // Lấy ra mảng id
                Cart::whereIn('id', $id)->update(['quantity' => $number]); // update các post có id trong mảng
                session()->flash('success', 'Thêm vào giỏ hàng thành công!');
                return redirect()->route('client.cart');
            }
        }
        //
        $product->save();
        return redirect()->route('client.cart');
    }
    public function deleteCart($products)
    {
        $data = Cart::find($products);
        $data->delete();
        return redirect()->route('client.cart');
    }
    public function single($id)
    {
        $dataProduct = Product::find($id);
        $cate = CategoryProduct::all();
        // dd($dataProduct->name);
        $productCate = Product::where('category_id', '=', $dataProduct->category_id)->skip(0)->take(3)->get();
        // dd($productCate);
        // dd($id);
        $comment = Comment::select('comments.*', 'users.name', 'users.avatar')->join('users', 'users.id', '=', 'comments.user_id')->join('products', 'products.id', '=', 'comments.product_id')->where('comments.product_id', '=', $id)->get();
        return view('KH.single-product', [
            'dataProduct' => $dataProduct,
            'cate' => $cate,
            'productCate' => $productCate,
            'comment' => $comment,

        ]);
    }
    public function storeComment(Request $request)
    {
        // dd($request->all());
        $data = new Comment();
        $data->fill($request->all());
        $data->dateComment = date('Y-m-d');
        // dd($data->dateComment);
        $data->save();
        return redirect()->back();
    }
    public function deleteComment($product)
    {
        $data = Comment::find($product);
        // dd($data->id);
        $data -> delete();
        return redirect()->back();
    }
    public function updateCart(Request $request,$id)
    {
        $data = Cart::find($id);
        dd($request->all());;
    }
    public function checkout()
    {
        // $helo=User::select('id','name','email')->where(Auth::id() == 'id')->get;
        // dd($helo->name);
        $id=Auth::id();
        $helo=User::find($id);
        $total = 0;
        $products = Cart::select('carts.*', 'products.nameProduct', 'products.avatar', 'products.price')->join('products', 'carts.productId', '=', 'products.id')->where('userId', '=', Auth::user()->id)->get();
        // dd($products);
        return view('KH.checkout', compact('helo','products', 'total'));
    }
    public function createOrder(Request $request)
    {
        // dd($request->all());
        
        $data = new Order();
        $data->orderDate = date('Y-m-d');
        $data->fill($request->all());
        $data->save();
        session()->flash('success', 'Bạn đã đặt hàng thành công');
        return redirect()->route('client.checkout');
    }
    public function storeOrder(OrderRequest $request)
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $nextId = $statement[0]->Auto_increment;
        // \dd($nextId);        
        $order = new Order();
        $order->orderDate = date('Y-m-d');
        $order->oderStatus = 0;
        $order->total = $request->total;
        $order->user_id = Auth::user()->id;
        $order->orderName = $request->orderName;
        $order->oderEmail = $request->oderEmail;
        $order->phone = $request->phone;
        $order->address = $request->address;
        // dd($request->total);
        $order->save();
        $carts = Cart::all()->where('userId', '=', Auth::user()->id);
        foreach ($carts as $it) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $nextId;
            $orderDetail->product_id = $it->productId;
            $orderDetail->oddNamePrd = 'a';
            $orderDetail->oddPricePrd = $it->price;
            $orderDetail->oddQuantityPrd = $it->quantity;
            $orderDetail->save();
            $it->delete();
        }
        session()->flash('success', 'Thanh toán hóa đơn thành công!');
        return redirect()->route('client.cart');
        // dd($carts);
    }
    public function profile($user)
    {
        $data = User::find($user);
        return view('KH.profile', compact('data'));
        // dd('adu');
    }
    public function editProfile($id)
    {
        $user = User::find($id);
        return view('KH.editProfile', [
            'user' => $user,
        ]);
    }
    public function updateProfile(User $user, UserRequest $request)
    {
        $userEdit = User::find($user->id);
        // dd($request->all());
        $userEdit->name = $request->name;
        $userEdit->username = $request->username;
        $userEdit->password = $request->password;
        $userEdit->email = $request->email;

        $request->avatar ? $userEdit->avatar = $request->avatar : $userEdit->avatar = $userEdit->avatar;

        //
        if ($request->hasFile('avatar')) {
            $avatarName = $request->avatar->hashName();
            $avatarName = $request->username . '_' . $avatarName;
            $userEdit->avatar = $request->avatar->storeAs('images/users', $avatarName);
        } else {
            $userEdit->avatar = $userEdit->avatar;
        }
        $request->role ? $userEdit->role = $request->role : $userEdit->role = $userEdit->role;
        //
        $request->status ? $userEdit->status = $request->status : $userEdit->status = $userEdit->status;

        $userEdit->save();
        return redirect()->route('client.profile', Auth::id());
    }
    public function report($user)
    {
        $data = User::find($user);

        $data->status = 1;

        $data->save();
        return redirect()->route('logout');
    }
}
