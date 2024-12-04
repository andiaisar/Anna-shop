<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerStoreController extends Controller
{
    public function index()
    {
        return view('seller.store.create');
    }

    public function manage()
    {
        $stores = Store::where('user_id', Auth::user()->id)->get();
        return view('seller.store.manage', compact('stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'unique:stores|required|max:100|min:3',
            'store_phone' => 'required|unique:stores',
            'store_description' => 'required',
            'store_address' => 'required',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048'

        ]);
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $filePath = $file->store('store_logos', 'public');
        } else {
            $filePath = null;
        }

        Store::create([
            'store_name' => $request->store_name,
            'store_phone' => $request->store_phone,
            'slug' => $request->store_name,
            'store_description' => $request->store_description,
            'store_address' => $request->store_address,
            'store_logo' => $filePath,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Store created successfully');
    }

    public function showstore($id)
    {
        $store_info = Store::find(id: $id);

        return view('seller.store.edit', compact('store_info'));
    }

    public function updatestore(Request $request, $id)
    {
        $store  = Store::findOrFail($id);
        $validate_data = $request->validate([
            'store_name' => 'required|string|max:255|min:3|unique:stores,store_name,' . $id,
            'store_phone' => 'required|string|max:255|unique:stores,store_phone,' . $id,
            'store_description' => 'required|string|max:255',
            'store_address' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $store ->update($validate_data);

        return redirect()->back()->with('success', 'store  updated successfully');
    }

    public function deletestore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->back()->with('success', 'Attribute deleted successfully');
    }
}
