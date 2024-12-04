<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->get();
        $totalProducts = $products->count();
        
        return view('seller.dashboard', [
            'totalProducts' => $totalProducts
        ]);
    }
}