@extends('customer.layouts.layout')
@section('customer-layout')

<section class="pt-24 pb-12 bg-gradient-to-b from-green-50 to-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('orders.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Order History
            </a>
        </div>
        <section class="relative pt-32 pb-24 bg-gradient-to-br from-green-50 via-white to-green-50 overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute top-0 left-0 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
    
            <div class="container mx-auto px-4 relative">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center space-y-8">
                        <h2 class="text-5xl md:text-6xl font-extrabold text-gray-900">
                            <span class="block">Welcome to</span>
                            <span class="block text-green-600 mt-2">ANNA<span class="text-yellow-500">Shop</span></span>
                        </h2>
                        <p class="text-xl md:text-2xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                            Discover amazing products at unbeatable prices, where quality meets affordability
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
                            <a href="#products" 
                               class="group relative inline-flex items-center px-8 py-3 overflow-hidden text-lg font-medium text-white bg-green-600 rounded-full hover:bg-green-700 transition-all duration-300">
                                <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                                <span class="relative flex items-center">
                                    Shop Now
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </a>
                            <a href="#categories" 
                               class="inline-flex items-center px-8 py-3 text-lg font-medium text-green-600 bg-transparent border-2 border-green-600 rounded-full hover:bg-green-50 transition-colors duration-300">
                                Browse Categories
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>  

<!-- Categories Section -->
<section id="categories" class="py-10 bg-gradient-to-b from-white to-green-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-3">Shop by Categories</h2>
        <p class="text-gray-600 text-center text-sm mb-8">Find what you love in our collections</p>
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category->id) }}" 
                   class="group relative overflow-hidden rounded-lg bg-white p-1.5 transition-all duration-300 hover:-translate-y-1">
                    <div class="aspect-square overflow-hidden rounded-lg shadow-sm transform transition-transform duration-300 group-hover:shadow-md">
                        <img src="{{ asset('storage/' . $category->category_image) }}" 
                             alt="{{ $category->category_name }}"
                             class="h-full w-full object-cover transform transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="mt-2 text-center">
                        <h3 class="text-sm font-medium text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                            {{ $category->category_name }}
                        </h3>
                        <div class="mt-0.5 h-0.5 w-0 bg-green-500 mx-auto transition-all duration-300 group-hover:w-1/3"></div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition relative flex flex-col h-full">
                <!-- Discount Badge -->
                @if ($product->discount && now()->between($product->discount->valid_from, $product->discount->valid_until))
                    <div class="absolute top-0 left-0 bg-red-500 text-white px-3 py-1 rounded-br-lg z-10">
                        <span class="text-sm font-bold">-{{ $product->discount->discount_percentage }}%</span>
                    </div>
                    <div class="absolute top-8 left-0 bg-yellow-400 text-black px-2 py-0.5 text-xs rounded-r">
                        Until {{ $product->discount->valid_until->format('d M') }}
                    </div>
                @endif

                <div class="flex flex-col h-full">
                    @if ($product->images->isNotEmpty())
                        <a href="{{ route('product.detail', $product->id) }}" class="block">
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
                        </a>
                    @endif
                    <div class="p-4 flex-grow">
                        <a href="{{ route('product.detail', $product->id) }}" class="block hover:text-green-600 transition-colors">
                            <h3 class="font-bold mb-2">{{ $product->product_name }}</h3>
                        </a>
                        @if ($product->discount && now()->between($product->discount->valid_from, $product->discount->valid_until))
                            <div class="space-y-1">
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-600 font-bold text-lg">
                                        Rp{{ number_format($product->regular_price * (1 - $product->discount->discount_percentage / 100), 0, ',', '.') }}
                                    </span>
                                    <span class="text-gray-500 line-through text-sm">
                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Hemat Rp{{ number_format($product->regular_price * $product->discount->discount_percentage / 100, 0, ',', '.') }}
                                </div>
                            </div>
                        @else
                            <p class="text-green-600 font-bold text-lg mb-2">
                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>
                    <div class="p-4 pt-0 mt-auto">
                        <a href="{{ route('product.detail', $product->id) }}" 
                           class="block w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition text-center">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection