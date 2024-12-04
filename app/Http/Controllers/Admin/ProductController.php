<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('store')->get();
        return view('admin.product.manage', compact('products'));
    }

    public function review_manage()
    {
        return view('admin.product.manage_product_review');
    }

    public function showWelcome()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
