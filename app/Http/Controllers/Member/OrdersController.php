<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderProduct;
use App\Model\Order;
use Sentinel;

class OrdersController extends Controller
{
   public function index()
   {
        $orders = Sentinel::check()->orders()->with('products')->get();

       return view('Pages.Member.Transaksi.Index')->with('orders', $orders);
   }

   public function show(Order $order)
   {
       if (Sentinel::check()->id !== $order->user_id) {
           return back()->withErrors('You do not have access to this!');
       }

       $products = $order->products;

       return view('Pages.Member.Transaksi.Show')->with([
           'order' => $order,
           'products' => $products,
       ]);
   }
}
