<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.create');
    }

    public function manage()
    {
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // $imagePath = null;
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('category_images', 'public');
        }

        Category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'category_image' => $imagePath
        ]);

        return redirect()->route('admin.category.create')->with('success', 'Category created successfully.');
    }
}
