<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::select(
            'id',   
            'orderDate',
            'user_id',
            'oderStatus',
            'phone',
            'address',
            'oderEmail',
            'orderName',
            'total',
        )
            // ->cursorPaginate(5);
            ->paginate(5);

            // dd($data);
        // dd($usersPaginate);
        return view('admin.order.list', ['order_list' => $data]);
    }
    public function updateStatusOrder(Request $request, $order) {
        // dd($request->all());
        $data = Order::find($order);
        $data->oderStatus = $request->oderStatus;
        // dd($data->orderStatus);
        session()->flash('sucssec','đơn hàng đã được cập nhật');
        $data->save();
        return redirect()->route('admin.orders.list');
    }
    public function showOrder()
    {
        $data = Order::all()->where('user_id','=',Auth::id());
        // (
        //     'id',   
        //     'orderDate',
        //     'user_id',
        //     'oderStatus',
        //     'phone',
        //     'address',
        //     'oderEmail',
        //     'orderName',
        //     'total',
        // )
            // ->cursorPaginate(5);
            // ->paginate(5);

            // dd($data);
        // dd($usersPaginate);
        return view('KH.order', ['order_list' => $data]);
    }
    
}
