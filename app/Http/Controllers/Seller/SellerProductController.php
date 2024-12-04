<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
    public function index()
    {
        $authUserid = Auth::id();
        $stores = Store::where('user_id', $authUserid)->get(); 
        $discounts = Diskon::all();
        return view('seller.product.create', compact('stores', 'discounts'));
    }

    public function manage()
    {
        $products = Product::where('seller_id', Auth::id())->get();
        return view('seller.product.manage', compact('products'));
    }

    public function showproduct($id)
    {
        $product_info = Product::where('id', $id)
            ->where('seller_id', Auth::id())
            ->first();

        if (!$product_info) {
            return redirect()
                ->route('seller.product.manage')
                ->with('error', 'Product not found');
        }

        return view('seller.product.edit', compact('product_info'));
    }

    public function updateproduct(Request $request, $id)
    {
        $product = Product::where('id', $id)
            ->where('seller_id', Auth::id())
            ->first();

        if (!$product) {
            return redirect()
                ->route('seller.product.manage')
                ->with('error', 'Product not found');
        }

        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'stock_quantity' => 'required|integer|min:0',
                'regular_price' => 'required|numeric|min:0',
            ]);

            $product->update([
                'product_name' => $request->product_name,
                'stock_quantity' => $request->stock_quantity,
                'regular_price' => $request->regular_price,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to update product')
                ->withInput();
        }
    }

    public function storeproduct(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'product_description' => 'nullable|string',
                'sku' => 'required|string|unique:products,sku',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'nullable|exists:subcategories,id',
                'store_id' => 'required|exists:stores,id',
                'regular_price' => 'required|numeric|min:0',
                'discounted_price' => 'nullable|numeric|min:0', 
                'stock_quantity' => 'required|integer|min:0',
                'tex_rate' => 'nullable|numeric|min:0|max:100',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
                'slug' => 'nullable|string|unique:products,slug',
                'discount_id' => 'nullable|exists:diskons,id',
            ]);

            $product = Product::create([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'sku' => $request->sku,
                'seller_id' => Auth::id(),
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'store_id' => $request->store_id,
                'regular_price' => $request->regular_price,
                'discounted_price' => $request->discounted_price,
                'stock_quantity' => $request->stock_quantity,
                'tex_rate' => $request->tex_rate,
                'slug' => $request->slug ?? Str::slug($request->product_name),
                'visibility' => $request->visibility ?? 1,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'discount_id' => $request->discount_id,
            ]);

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'is_primary' => $index === 0 // First image will be primary
                    ]);
                }
            }

            return redirect()
                ->route('seller.product.manage')
                ->with('success', 'Product has been added successfully!')
                ->with('product_id', $product->id);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to add product. Please try again.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('seller.product.manage')
            ->with('success', 'Produk berhasil dihapus!');
    }    
}