<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerMainController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                  ->orWhere('product_description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->latest()->get();
        return view('customer.product.listProduct', compact('products', 'categories'));
    }

    public function history()
    {
        return view('customer.history');
    }

    public function payment()
    {
        return view('customer.payment');
    }

    public function affiliate()
    {
        return view('customer.affiliate');
    }

    
}
