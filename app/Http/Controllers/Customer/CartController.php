<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();
            $total = $cartItems->sum(function($item) {
                return $item->quantity * ($item->product->price ?? 0);
            });
            return view('customer.cart.customerCart', compact('cartItems', 'total'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading cart: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $cekProduk = Cart::where('product_id', $request->product_id)->where('user_id', $user->id)->first();
            if($cekProduk){
                $cekProduk->increment('quantity', $request->quantity);
                return redirect()->route('cart.index')->with('success', 'Product added to cart.');
            }

            $cart = Cart::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]
            );

            // $cart->increment('quantity', $request->quantity);

            return redirect()->route('cart.index')->with('success', 'Product added to cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding to cart: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = Auth::user();
            Cart::where('id', $id)
                ->where('user_id', $user->id)
                ->delete();

            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error removing item: ' . $e->getMessage());
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            $cart = Cart::findOrFail($id);

            if ($cart->user_id !== $user->id) {
                throw new \Exception('Unauthorized access');
            }

            $cart->update(['quantity' => $request->quantity]);

            return response()->json([
                'success' => true,
                'newQuantity' => $cart->quantity,
                'total' => $cart->quantity * $cart->product->price
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    } 
    public function getCartCount()
{
    
    $user = Auth::user();
    if (!$user) {
        return response()->json(['count' => 0]);
    }
    
    $count = Cart::where('user_id', $user->id)->sum('quantity');
    return response()->json(['count' => $count]);
}
}
