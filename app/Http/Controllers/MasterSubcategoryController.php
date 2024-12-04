<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class MasterSubcategoryController extends Controller
{
    public function storesubcat(Request $request)
    {
        $validate_data = $request->validate([
            'subcategory_name' => 'required|string|max:100|min:3|unique:subcategories,subcategory_name,NULL,id,category_id,' . $request->category_id,
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create($validate_data);

        return redirect()->back()->with('success', 'Sub Category added successfully');
    }

    public function showsubcat($id)
    {
        $subcategory_info = Subcategory::find(id: $id);

        return view('admin.sub_category.edit', compact('subcategory_info'));
    }

    public function updatesubcat(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $validate_data = $request->validate([
            'subcategory_name' => 'required|string|max:100|unique:subcategories,subcategory_name,' . $id . ',id,category_id,' . $request->category_id,
        ]);

        $subcategory->update($validate_data);

        return redirect()->back()->with('success', 'Sub Category updated successfully');
    }

    public function deletesubcat($id)
    {
        $category = Subcategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Sub Category deleted successfully');
    }
}
