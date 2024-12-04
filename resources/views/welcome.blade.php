<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnnaShop - Your Premium Shopping Destination</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 fixed w-full z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white">ANNA<span class="text-yellow-400">Shop</span></h1>
                
                <nav class="hidden md:flex space-x-6">
                    <a href="#categories" class="text-white hover:text-yellow-200 transition">Categories</a>
                    <a href="#products" class="text-white hover:text-yellow-200 transition">Products</a>

                    @if (!in_array(Route::currentRouteName(), ['cart.index', 'order.success']))
                        <form action="{{ route('welcome') }}" method="GET" class="md:flex items-center flex-1 max-w-md mx-4">
                            <div class="relative w-full">
                                <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white hover:text-yellow-300">
                                    <i class="fas fa-search"></i>
                                </button>
                                <input type="text" 
                                    name="search" 
                                    placeholder="Search products..." 
                                    value="{{ request('search') }}"
                                    class="w-full bg-white/20 text-white placeholder-gray-100 px-4 py-2 pl-10 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:bg-white/30 text-sm"
                                >
                            </div>
                        </form>
                    @endif
                </nav>

                <div class="flex items-center space-x-4">
                    <button onclick="toggleCart()" class="text-white hover:text-yellow-200">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cartCount" class="bg-yellow-400 text-xs text-black px-2 py-1 rounded-full">0</span>
                    </button>
                    
                    @if (Route::has('login'))
                        <div class="space-x-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white hover:text-yellow-200">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-200">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-200">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Cart Sidebar -->
    <div id="cartPanel" class="fixed right-0 top-0 h-full w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Your Cart</h2>
                <button onclick="toggleCart()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="cartItems" class="space-y-4 max-h-[60vh] overflow-y-auto">
                <!-- Cart items will be inserted here -->
            </div>
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Total:</span>
                    <span id="cartTotal" class="font-bold">$0.00</span>
                </div>
                <button onclick="handleCheckout()" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
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

    <!-- Categories Section -->
    <section id="categories" class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Shop by Categories</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->id) }}" class="category hover:transform hover:scale-105 transition-transform">
                        <div class="category-image" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 10px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $category->category_image) }}" alt="{{ $category->category_name }}">
                        </div>
                        <h3 class="text-center mt-2">{{ $category->category_name }}</h3>
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
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition relative">
                    <!-- Discount Badge -->
                    @if ($product->discount && now()->between($product->discount->valid_from, $product->discount->valid_until))
                        <div class="absolute top-0 left-0 bg-red-500 text-white px-3 py-1 rounded-br-lg z-10">
                            <span class="text-sm font-bold">-{{ $product->discount->discount_percentage }}%</span>
                        </div>
                        <div class="absolute top-8 left-0 bg-yellow-400 text-black px-2 py-0.5 text-xs rounded-r">
                            Until {{ $product->discount->valid_until->format('d M') }}
                        </div>
                    @endif

                    <a href="{{ route('product.detail', $product->id) }}" class="block">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                alt="{{ $product->name }}"
                                class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold mb-2">{{ $product->product_name }}</h3>
                            @if ($product->discount && now()->between($product->discount->valid_from, $product->discount->valid_until))
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-green-600 font-bold text-lg">
                                            ${{ number_format($product->regular_price * (1 - $product->discount->discount_percentage / 100), 2) }}
                                        </span>
                                        <span class="text-gray-500 line-through text-sm">${{ $product->regular_price }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500"></div>
                                        Save ${{ number_format($product->regular_price * $product->discount->discount_percentage / 100, 2) }}
                                    </div>
                                </div>
                            @else
                                <p class="text-green-600 font-bold text-lg mb-2">${{ $product->regular_price }}</p>
                            @endif
                            <button onclick="event.preventDefault(); addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->regular_price }})" 
                                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition mt-2">
                                Add to Cart
                            </button>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(session('cart'))
        
    @endif

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <p>&copy; 2024 AnnaShop. All Rights Reserved.</p>
            <ul class="socials">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
    </footer>

    <script>
        let cart = [];
        
        function toggleCart() {
            const cartPanel = document.getElementById('cartPanel');
            cartPanel.classList.toggle('translate-x-full');
        }

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1
                });
            }
            
            updateCartUI();
            
            // Show notification
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
            notification.textContent = 'Product added to cart!';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 2000);

            // Open cart panel
            toggleCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCartUI();
        }

        function updateQuantity(id, change) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity = Math.max(1, item.quantity + change);
                updateCartUI();
            }
        }

        function updateCartUI() {
            const cartItems = document.getElementById('cartItems');
            const cartCount = document.getElementById('cartCount');
            const cartTotal = document.getElementById('cartTotal');
            
            cartItems.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-gray-500 text-center">Your cart is empty</p>';
            } else {
                cart.forEach(item => {
                    total += item.price * item.quantity;
                    cartItems.innerHTML += `
                        <div class="flex flex-col p-2 border rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-bold">${item.name}</h4>
                                <button onclick="removeFromCart(${item.id})" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <button onclick="updateQuantity(${item.id}, -1)" class="px-2 py-1 bg-gray-200 rounded">-</button>
                                    <span>${item.quantity}</span>
                                    <button onclick="updateQuantity(${item.id}, 1)" class="px-2 py-1 bg-gray-200 rounded">+</button>
                                </div>
                                <p class="font-semibold">$${(item.price * item.quantity).toFixed(2)}</p>
                            </div>
                        </div>
                    `;
                });
            }

            cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartTotal.textContent = `$${total.toFixed(2)}`;
        }

        function handleCheckout() {
            @auth
                // If user is logged in, proceed to checkout
                window.location.href = "{{ route('checkout') }}";
            @else
                // If user is not logged in, redirect to login
                window.location.href = "{{ route('login') }}";
            @endauth
        }
    </script>
</body>
</html>
