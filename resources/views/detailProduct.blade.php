<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->product_name }} - AnnaShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <header class="bg-gradient-to-r from-green-600 to-green-700 fixed w-full z-50">
    </header>

    <!-- Product Detail Section -->
    <div class="pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Image Gallery -->
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <img id="mainImage" src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                             alt="{{ $product->product_name }}"
                             class="w-full h-96 object-cover rounded-lg">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                        <img onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')" 
                             src="{{ asset('storage/' . $image->image_path) }}"
                             alt="Product thumbnail"
                             class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition">
                        @endforeach
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <h1 class="text-3xl font-bold">{{ $product->product_name }}</h1>
                    
                    <!-- Price Section -->
                    <div class="space-y-4">
                        @if ($product->discount && now()->between($product->discount->valid_from, $product->discount->valid_until))
                            <div class="bg-red-50 border border-red-100 rounded-lg p-4 space-y-2">
                                <div class="flex items-center space-x-3">
                                    <span class="text-3xl font-bold text-green-600">
                                        ${{ number_format($product->regular_price * (1 - $product->discount->discount_percentage / 100), 2) }}
                                    </span>
                                    <span class="text-xl text-gray-500 line-through">${{ $product->regular_price }}</span>
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        -{{ $product->discount->discount_percentage }}% OFF
                                    </span>
                                </div>
                                <div class="text-sm space-y-1">
                                    <p class="text-gray-600">
                                        <i class="fas fa-clock text-red-500 mr-1"></i>
                                        Sale ends: {{ $product->discount->valid_until->format('M d, Y') }}
                                    </p>
                                    <p class="text-green-600 font-medium">
                                        <i class="fas fa-tag mr-1"></i>
                                        You save: ${{ number_format($product->regular_price * $product->discount->discount_percentage / 100, 2) }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="text-3xl font-bold text-green-600">${{ $product->regular_price }}</div>
                        @endif
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600">(4.5/5 - 128 reviews)</span>
                    </div>
                    <p class="text-gray-600">{{ $product->short_description }}</p>
                    
                    <!-- Add to Cart Section -->
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-center space-x-4 w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1" id="quantity">
                            <div class="flex items-center border rounded-lg">
                                <button type="button" class="px-4 py-2 hover:bg-gray-100" onclick="updateQuantity(-1)">-</button>
                                <input type="number" id="quantityDisplay" value="1" class="w-16 text-center border-x py-2" readonly>
                                <button type="button" class="px-4 py-2 hover:bg-gray-100" onclick="updateQuantity(1)">+</button>
                            </div>
                            <button type="submit" class="flex-1 bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition">
                                Add to Cart
                            </button>
                        </form>
                    </div>

                    <!-- Product Features -->
                    <div class="border-t pt-6 space-y-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-truck text-green-600"></i>
                            <span>Free shipping on orders over $100</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-undo text-green-600"></i>
                            <span>30-day return policy</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-shield-alt text-green-600"></i>
                            <span>2-year warranty</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description & Reviews -->
            <div class="mt-12">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8">
                        <button class="border-b-2 border-green-600 py-4 px-1 text-green-600 font-medium">
                            Description
                        </button>
                        <button class="py-4 px-1 text-gray-600 font-medium">
                            Reviews (128)
                        </button>
                    </nav>
                </div>

                <!-- Description Content -->
                <div class="py-6">
                    <div class="prose max-w-none space-y-4">
                        <div class="text-gray-800">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                        @if($product->product_description)
                            <div class="mt-4 text-gray-800">
                                <h4 class="font-semibold mb-2">Additional Information:</h4>
                                {!! nl2br(e($product->product_description)) !!}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold">Customer Reviews</h3>
                    
                    @auth
                    <form action="{{ route('reviews.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-4">
                            <label class="block mb-2">Your Rating</label>
                            <div class="flex space-x-2">
                                @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" class="hidden peer" required>
                                <label for="rating{{ $i }}" class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400">
                                    ★
                                </label>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2">Your Review</label>
                            <textarea name="comment" rows="3" class="w-full border rounded-lg p-2" required></textarea>
                        </div>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Submit Review
                        </button>
                    </form>
                    @endauth

                    <!-- Review Items -->
                    @foreach($product->reviews as $review)
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="https://via.placeholder.com/40" alt="User" class="rounded-full">
                            <div>
                                <h4 class="font-bold">{{ $review->user->name }}</h4>
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600">{{ $review->comment }}</p>
                    </div>
                    @endforeach
                </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
    </footer>

    <script>
        function changeMainImage(imagePath) {
            document.getElementById('mainImage').src = imagePath;
        }

        function updateQuantity(amount) {
            let quantityInput = document.querySelector('input[name="quantity"]');
            let quantityDisplay = document.getElementById('quantityDisplay');
            let currentQuantity = parseInt(quantityDisplay.value);
            let newQuantity = currentQuantity + amount;
            
            if (newQuantity >= 1) {
                quantityDisplay.value = newQuantity;
                quantityInput.value = newQuantity;
            }
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

    </script>
</body>
</html>
