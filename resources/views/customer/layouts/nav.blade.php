<header class="bg-gradient-to-r from-green-600 to-green-700 fixed w-full z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-white">ANNA<span class="text-yellow-400">Shop</span></h1>
            
            <nav class="hidden md:flex space-x-6">
                <a href="#categories" class="text-white text-base font-medium hover:text-yellow-300 transition">Categories</a>
                <a href="#products" class="text-white text-base font-medium hover:text-yellow-300 transition">Products</a>
                <a href="#contact" class="text-white text-base font-medium hover:text-yellow-300 transition">Contact</a>
            </nav>

            {{-- Fitur Search --}}
            @if (!in_array(Route::currentRouteName(), ['cart.index', 'order.success']))
                <form action="{{ route('customer.dashboard') }}" method="GET" class="md:flex items-center flex-1 max-w-md mx-4 group">
                    <div class="relative w-full">
                        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 transition-colors duration-300 group-hover:text-yellow-300">
                            <i class="fas fa-search fa-lg"></i>
                        </button>
                        <input type="text" 
                            name="search" 
                            placeholder="What are you looking for?" 
                            value="{{ request('search') }}"
                            class="w-full bg-white/10 text-white placeholder-gray-300 px-12 py-3 rounded-xl
                                    transition-all duration-300 ease-in-out
                                    border-2 border-transparent
                                    focus:outline-none focus:border-yellow-300 focus:bg-white/20
                                    hover:bg-white/15
                                    text-sm backdrop-blur-sm"
                        >
                        <button type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-yellow-300 transition-colors duration-300"
                                onclick="this.previousElementSibling.value = ''"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </form>
            @endif

            <div class="flex items-center space-x-4">
                <a href='{{ route('cart.index') }}' class="text-white hover:text-yellow-300">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span id="cartCount" class="bg-yellow-400 text-xs font-medium text-green-800 px-2 py-1 rounded-full">0</span>
                </a>
                
                @if (Route::has('login'))
                    <div class="space-x-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white font-medium hover:text-yellow-300">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-yellow-300 font-medium hover:text-yellow-100">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-yellow-300 font-medium hover:text-yellow-100">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-yellow-300 font-medium hover:text-yellow-100">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

<script>
function updateCartCount() {
    fetch('{{ route("cart.count") }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('cartCount').textContent = data.count;
        })
        .catch(error => console.error('Error:', error));
}

// Update cart count when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
</script>