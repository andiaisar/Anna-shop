<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diskon;

class DiskonController extends Controller
{
    public function index()
    {
        return view('admin.discount.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount_name' => 'required|string|max:255',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
        ]);

        Diskon::create($request->all());

        return redirect()->route('discount.create')->with('success', 'Discount created successfully.');
    }

    public function manage()
    {
        $discounts = Diskon::all();
        return view('admin.discount.manage', compact('discounts'));
    }

    public function destroy($id)
    {
        $discount = Diskon::findOrFail($id);
        $discount->delete();

        return redirect()->route('discount.manage')->with('success', 'Discount deleted successfully.');
    }
}
