<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', Auth::id())->first();
        if (!$store) {
            return redirect()->route('seller.dashboard')->with('error', 'Please create a store first');
        }

        $orders = Order::whereHas('orderItems.product', function($query) use ($store) {
            $query->where('store_id', $store->id);
        })->with(['orderItems.product', 'user'])->orderBy('created_at', 'desc')->paginate(10);
        
        return view('seller.order', compact('orders'));
    }

    public function show($id)
    {
        $store = Store::where('user_id', Auth::id())->first();
        $order = Order::whereHas('orderItems.product', function($query) use ($store) {
            $query->where('store_id', $store->id);
        })->findOrFail($id);
        
        return view('seller.order-detail', compact('order'));
    }
}