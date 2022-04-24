<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $orders = Order::paginate(10);
        $statuses = Status::get();
        return view("backend.pages.order", compact("orders", "statuses"));
    }

    public function orderupdate(Request $request, $id)
    {
        $data = $request->except(['_token']);
        Order::whereId($id)->update($data);
        return redirect()->back()->with('success', 'Sipariş başarılı bir şekilde güncellendi.');
    }
}
