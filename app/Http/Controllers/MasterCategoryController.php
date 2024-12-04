<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    public function storecat(Request $request)
    {
        $validate_data = $request->validate([
            'category_name' => 'unique:categories|required|string|max:100|min:3',
            'category_description' => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048'
        ]);

        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('category_images', 'public');
        }

        Category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'category_image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function showcat($id)
    {
        $category_info = Category::find(id: $id);

        return view('admin.category.edit', compact('category_info'));
    }

    public function updatecat(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validate_data = $request->validate([
            'category_name' => 'required|string|max:255|min:3|unique:categories,category_name,'.$id,
            'category_description' => 'required|string|max:255',
        ]);

        $category->update($validate_data);

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function deletecat($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
