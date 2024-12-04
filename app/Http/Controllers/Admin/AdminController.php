<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::where('role', 'user')->count(),
            'totalSellers' => User::where('role', 'seller')->count(),
            'totalProducts' => Product::count(),
            'users' => User::all() // for the user management table
        ];

        return view('admin.admin', $data);
    }
}