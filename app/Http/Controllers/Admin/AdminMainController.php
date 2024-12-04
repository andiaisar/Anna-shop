<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::where('role', 'buyer')->count(),
            'totalSellers' => User::where('role', 'seller')->count(),
            'totalProducts' => Product::count(),
            'users' => User::all()
        ];

        return view('admin.admin', $data);
    }
    public function setting()
    {
        return view('admin.settings');
    }
    public function manage_user()
    {
        return view('admin.manage.user');
    }
    public function manage_stores()
    {
        return view('admin.manage.store');
    }
    public function cart_history()
    {
        return view('admin.cart.history');
    }
    public function order_history()
    {
        return view('admin.order.history');
    }

    
}
