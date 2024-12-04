<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('customer.product.detailProduct', compact('product'));
    }

    public function showWelcome(Request $request)
    {
        $query = $request->input('search');
        
        $products = Product::query();
        $categories = Category::all();
        
        if ($query) {
            $products->where(function($q) use ($query) {
                $q->where('product_name', 'like', "%{$query}%")
                  ->orWhere('product_description', 'like', "%{$query}%");
            });
        }
        
        $products = $products->paginate(12);
        
        return view('welcome', compact('products','categories'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->product_name,
                "quantity" => $request->quantity,
                "price" => $product->regular_price,
                "image" => $product->images->first()->image_path
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('welcome');
    }

    
}