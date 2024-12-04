@extends('admin.layouts.layout')
@section('admin_page_title')
    Manage Products
@endsection
@section('admin-layout')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    <span class="block">Product Management</span>
                    <span class="block text-blue-600 text-xl mt-1">Overview of all products</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="relative">
                            <img class="h-48 w-full object-cover" src="{{ $product->primary_image_url }}" alt="{{ $product->product_name }}">
                            <div class="absolute top-0 right-0 m-2">
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">
                                    In Stock: {{ $product->stock_quantity }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->product_name }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $product->store->store_name }}</p>
                                </div>
                                <p class="text-2xl font-bold text-blue-600">${{ number_format($product->regular_price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection