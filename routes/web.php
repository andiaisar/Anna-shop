<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\MastercategoryController;
use App\Http\Controllers\MasterSubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerStoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Admin\DiskonController; 
use App\Http\Controllers\ReviewController; 
use App\Http\Controllers\Customer\CartController; 
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Seller\SellerOrderController;

Route::get('/', [FrontendProductController::class, 'showWelcome'])->name('welcome');


// Add this new route for admin auth redirect
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'rolemanager:admin'])->name('admin');

// Add this route for dashboard redirect after login
Route::get('/dashboard', function () {
    $role = Auth::user()->role ?? 'buyer';

    switch ($role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'seller':
            return redirect()->route('seller.dashboard');
        default:
            return redirect()->route('customer.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     $role = Auth::user()->role ?? 'buyer';
//     switch ($role) {
//         case 'admin':
//             return redirect()->route('admin.dashboard');
//         case 'seller':
//             return redirect()->route('seller.dashboard');
//         default:
//             return redirect()->route('customer.dashboard');
//     }
// })->middleware(['auth'])->name('dashboard');

// Route::get('/', );

// Remove or comment out these routes as they're causing conflicts
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'role:admin'])->name('admin');

// Route::get('/seller', function () {
//     return view('seller.dashboard');
// })->middleware(['auth', 'role:seller'])->name('seller');

// Admin routes
Route::middleware(['auth', 'rolemanager:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminMainController::class, 'index'])->name('admin.dashboard');
    Route::controller(AdminMainController::class)->group(function () {
        Route::get('/settings', 'setting')->name('admin.settings');
        Route::get('/manage/users', 'manage_user')->name('admin.manage.user');
        Route::get('/manage/stores', 'manage_stores')->name('admin.manage.store');
        Route::get('/cart/history', 'cart_history')->name('admin.cart.history');
        Route::get('/order/history', 'order_history')->name('admin.order.history');
    });

    Route::controller(UserManagementController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users', 'store')->name('users.store');
        Route::get('/users/{user}/edit', 'edit')->name('users.edit');
        Route::put('/users/{user}', 'update')->name('users.update');
        Route::delete('/users/{user}', 'destroy')->name('users.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/create', 'index')->name('catagory.create');
        Route::get('/catagory/manage', 'manage')->name('catagory.manage');
        Route::get('/category/manage', 'manage')->name('category.manage'); // Add this line
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/subcategory/create', 'index')->name('subcatagory.create');
        Route::get('/subcatagory/manage', 'manage')->name('subcatagory.manage');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/manage', 'index')->name('product.manage');
        Route::get('/product/review/manage', 'review_manage')->name('product.review.manage');
    });

    Route::controller(ProductAttributeController::class)->group(function () {
        Route::get('/productattribute/create', 'index')->name('productattribute.create');
        Route::get('/productattribute/manage', 'manage')->name('productattribute.manage');
        Route::post('/defaultattribute/store', 'createattribute')->name('attribute.create');
        Route::get('/defaultattribute/{id}', 'showattribute')->name('show.attribute');
        Route::put('/defaultattribute/update/{id}', 'updateattribute')->name('update.attribute');
        Route::delete('/defaultattribute/delete/{id}', 'deleteattribute')->name('delete.attribute');
    });

    Route::controller(DiskonController::class)->group(function () { // Update this line
        Route::get('/discount/create', 'index')->name('discount.create');
        Route::get('/discount/manage', 'manage')->name('discount.manage');
        Route::post('/discount/store', 'store')->name('admin.discount.store'); // Update this line
        Route::delete('/discount/{id}', 'destroy')->name('admin.discount.destroy');
    });

    Route::controller(MasterCategoryController::class)->group(function () {
        Route::post('/store/category', 'storecat')->name('store.cat');
        Route::get('/category/{id}', 'showcat')->name('show.cat');
        Route::put('/category/update/{id}', 'updatecat')->name('update.cat');
        Route::delete('/category/delete/{id}', 'deletecat')->name('delete.cat');
    });
    Route::controller(MasterSubcategoryController::class)->group(function () {
        Route::post('/store/subcategory', 'storesubcat')->name('store.subcat');
        Route::get('/subcategory/{id}', 'showsubcat')->name('show.subcat');
        Route::put('/subcategory/update/{id}', 'updatesubcat')->name('update.subcat');
        Route::delete('/subcategory/delete/{id}', 'deletesubcat')->name('delete.subcat');
        
    });
});

// Add seller redirect route - add this before seller routes group
Route::get('/seller', function () {
    return redirect()->route('seller.dashboard');
})->middleware(['auth', 'rolemanager:seller'])->name('seller');

// Seller routes
Route::middleware(['auth', 'rolemanager:seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerMainController::class, 'index'])->name('seller.dashboard');
    Route::controller(SellerMainController::class)->group(function () {
        Route::get('/order/history', 'order_history')->name('seller.order.history');
    });
    Route::controller(SellerProductController::class)->group(function () {
        Route::get('/product/create', 'index')->name('seller.product');
        Route::post('/product/store', 'storeproduct')->name('seller.product.create');
        Route::get('/product/manage', 'manage')->name('seller.product.manage');
        Route::get('/product/{id}', 'showproduct')->name('show.product');
        Route::delete('/product/{id}', 'destroy')->name('delete.product');
        Route::put('/product/update/{id}', 'updateproduct')->name('seller.product.update');
    });
    Route::controller(SellerStoreController::class)->group(function () {
        Route::get('/store/create', 'index')->name('selle.store');
        Route::get('/store/manage', 'manage')->name('selle.store.manage');
        Route::post('/store/publish', 'store')->name('create.store');
        Route::get('/store/{id}', 'showstore')->name('show.store');
        Route::put('/store/update/{id}', 'updatestore')->name('update.store');
        Route::delete('/store/delete/{id}', 'deletestore')->name('delete.store');
    });
    Route::controller(SellerOrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('seller.orders');
        Route::get('/orders/{id}', 'show')->name('seller.orders.show');
    });
});

// Customer routes
Route::middleware(['auth', 'rolemanager:buyer'])->prefix('user')->group(function () {
    Route::get('/dashboard', [CustomerMainController::class, 'index'])->name('customer.dashboard');
    Route::controller(CustomerMainController::class)->group(function () {
        Route::get('/order/history', 'history')->name('customer.history');
        Route::get('/setting/payment', 'payment')->name('customer.payment');
        Route::get('/affiliate', 'affiliate')->name('customer.affiliate');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('customer.reviews');

    });

    // Order routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders.index');
        Route::post('/orders', 'store')->name('orders.store');  
        Route::get('/orders/{order}', 'show')->name('orders.show');
        Route::get('/orders/create', 'create')->name('orders.create');
        Route::get('/orders/{order}/edit', 'edit')->name('orders.edit');
        Route::put('/orders/{order}', 'update')->name('orders.update');
        Route::delete('/orders/{order}', 'destroy')->name('orders.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // ...existing code...
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::post('/cart/{id}/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Remove these duplicate order routes
// Route::middleware(['auth'])->group(function () {
//     Route::controller(OrderController::class)->group(function () {
//         Route::get('/orders', 'index')->name('orders.index');
//         Route::get('/orders/create', 'create')->name('orders.create');
//         Route::post('/orders', 'store')->name('orders.store');
//         Route::get('/orders/{order}', 'show')->name('orders.show');
//         Route::get('/orders/{order}/edit', 'edit')->name('orders.edit');
//         Route::put('/orders/{order}', 'update')->name('orders.update');
//         Route::delete('/orders/{order}', 'destroy')->name('orders.destroy');
//     });
// });

// Route::post('/cart/add', [FrontendProductController::class, 'addToCart'])->name('cart.add');

// Add a new route for product detail
Route::get('/product/{id}', [FrontendProductController::class, 'show'])->name('product.detail');

// Add a new route for category products
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');

// Move this to the end of the file
require __DIR__.'/auth.php';

// ...existing code...
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
// ...existing code...
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('products.search');
// ...existing code...