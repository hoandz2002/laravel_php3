<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    public function index($order) {
      $orders=OrderDetail::select('order_details.*','products.nameProduct','products.avatar')
      ->join('products','order_details.product_id','=','products.id')
      ->where('order_id' , '=', $order)->get();
    //    dd($orders);
        $data = Order::find($order);
        // dd($data);
        $total = 0;
        return view('admin.order.detail', compact('orders','data', 'total'));
    }
    public function detail($order) {
        $orders=OrderDetail::select('order_details.*','products.nameProduct','products.avatar')
        ->join('products','order_details.product_id','=','products.id')
        ->where('order_id' , '=', $order)->get();
      //    dd($orders);
          $data = Order::find($order);
          // dd($data);
          $total = 0;
          return view('KH.detail', compact('orders','data', 'total'));
      }
      public function updateStatusOrder($order)
      {
        $updateStatus = Order::find($order);
        if($updateStatus->oderStatus == 0){
            $updateStatus->oderStatus = 3;
        }
        if($updateStatus->oderStatus == 1){
          session()->flash('danger', 'Bạn không thể hủy đơn');
          return redirect()->route('client.showOrder');

        }
        if($updateStatus->oderStatus == 2){
          session()->flash('danger', 'Bạn không thể hủy đơn');
          return redirect()->route('client.showOrder');

        }
        
        $updateStatus->save();
        session()->flash('success', 'Bạn đã cập nhật trạng thái thành công!');
        return redirect()->route('client.showOrder');
      }
   
}
