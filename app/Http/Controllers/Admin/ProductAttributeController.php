<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index()
    {
        return view('admin.product_attribute.create');
    }

    public function manage()
    {
        $allattributes = DefaultAttribute::all();
        return view('admin.product_attribute.manage', compact('allattributes'));
    }

    public function createattribute(Request $request)
    {
        $validate_data = $request->validate([
            'attribute_value' => 'unique:default_attributes|required|string|max:100|min:1',
        ]);

        DefaultAttribute::create($validate_data);

        return redirect()->back()->with('success', 'Default Attribute added successfully');
    }

    public function showattribute($id)
    {
        $attribute_info = DefaultAttribute::find(id: $id);

        return view('admin.product_attribute.edit', compact('attribute_info'));
    }

    public function updateattribute(Request $request, $id)
    {
        $attribute = DefaultAttribute::findOrFail($id);
        $validate_data = $request->validate([
            'attribute_value' => 'unique:default_attributes|required|string|min:1',
        ]);

        $attribute->update($validate_data);

        return redirect()->back()->with('success', 'Attribute updated successfully');
    }

    public function deleteattribute($id)
    {
        $category = DefaultAttribute::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Attribute deleted successfully');
    }
}
