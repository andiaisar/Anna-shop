<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with(['orderItems.product.images'])
                      ->latest()
                      ->get();
        
        return view('customer.historyOrder', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        // try {
            DB::beginTransaction();

            // Validate request
            $request->validate([
                'items' => 'required|array',
                'shipping_cost' => 'required|numeric',
                'payment_method' => 'required|in:transfer,cod',
                'total_amount' => 'required|numeric'
                
            ]);

            // Generate invoice number
            $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(uniqid());

            // Create order
            $order = Order::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => Auth::id(),
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_cost' => $request->shipping_cost,
                'total_amount' => $request->total_amount
            ]);

            // Process order items
            foreach ($request->items as $itemData) {
                $item = json_decode($itemData, true);
                $cart = Cart::findOrFail($item['cart_id']);
                $product = Product::findOrFail($cart->product_id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $item['quantity'],
                    'price' => $product->regular_price,
                    'subtotal' => $product->regular_price * $item['quantity']
                ]);

                $cart->delete();
            }

            DB::commit();
            return redirect()->route('orders.index')
                           ->with('success', 'Order has been placed successfully!');

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     // \Log::error('Order creation failed: ' . $e->getMessage());
        //     return back()->with('error', 'Failed to create order. Please try again.');
        // }
    }

    public function show(Order $order)
    {
        // Add authorization check
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }

    public function history()
    {
        $orders = Order::with(['orderItems.product'])
            ->latest()
            ->get();

        return view('admin.order.history', compact('orders'));
    }
}