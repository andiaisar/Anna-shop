<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SellerMainController extends Controller
{
    public function index()
    {
        $authUserId = Auth::id();
        $totalProducts = Product::where('seller_id', $authUserId)->count();
        $products = Product::where('seller_id', $authUserId)
            ->with('images')
            ->latest()
            ->get();

        return view('seller.dashboard', compact('totalProducts', 'products'));
    }

    public function order_history()
    {
        return view('seller.order');
    }
}
