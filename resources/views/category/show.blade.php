
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->category_name }} - AnnaShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-600 to-green-700 fixed w-full z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white">ANNA<span class="text-yellow-400">Shop</span></h1>
                
                {{-- <nav class="hidden md:flex space-x-6">
                    <a href="#categories" class="text-white hover:text-yellow-200 transition">Categories</a>
                    <a href="#products" class="text-white hover:text-yellow-200 transition">Products</a>
                    <a href="#contact" class="text-white hover:text-yellow-200 transition">Contact</a>
                </nav> --}}

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

    <section class="pt-24 pb-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">{{ $category->category_name }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                        <a href="{{ route('product.detail', $product->id) }}" class="block">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" 
                                     alt="Default Image"
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold mb-2">{{ $product->product_name }}</h3>
                                <p class="text-green-600 font-bold mb-2">${{ $product->regular_price }}</p>
                                <button onclick="event.preventDefault(); addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->regular_price }})" 
                                        class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                                    Add to Cart
                                </button>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">No products found in this category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

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