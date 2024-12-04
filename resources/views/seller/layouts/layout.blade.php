<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce seller | @yield('seller_page_title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-gray-50 font-inter">
	{{-- @vite('recources/css/app.css') --}}
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <span class="text-xl font-semibold text-gray-800">Seller Dashboard</span>
                    <button class="md:hidden" onClick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <div class="mb-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Main</p>
                        <a href="{{ route('seller') }}" 
                           class="flex items-center px-4 py-2 mt-2 text-sm {{ request()->routeIs('seller')?'bg-blue-50 text-blue-600':'text-gray-600' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    <!-- Store Section -->
                    <div class="mb-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Store</p>
                        <div class="space-y-1 mt-2">
                            <a href="{{ route('selle.store') }}" 
                               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('selle.store')?'bg-blue-50 text-blue-600':'text-gray-600' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span>Create Store</span>
                            </a>
                            <a href="{{ route('selle.store.manage') }}" 
                               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('selle.store.manage')?'bg-blue-50 text-blue-600':'text-gray-600' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                                <span>Manage Store</span>
                            </a>
                        </div>
                    </div>

                    <!-- Products Section -->
                    <div class="mb-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Products</p>
                        <div class="space-y-1 mt-2">
                            <a href="{{ route('seller.product') }}" 
                               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('seller.product')?'bg-blue-50 text-blue-600':'text-gray-600' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span>Add Product</span>
                            </a>
                            <a href="{{ route('seller.product.manage') }}" 
                               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('seller.product.manage')?'bg-blue-50 text-blue-600':'text-gray-600' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                                <span>Manage Products</span>
                            </a>
                        </div>
                    </div>

                    {{-- <div class="mb-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Orders</p>
                        <div class="space-y-1 mt-2">
                            <a href="{{ route('seller.orders') }}" 
                               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('seller.orders')?'bg-blue-50 text-blue-600':'text-gray-600' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span>Customer Orders</span>
                            </a>
                        </div>
                    </div> --}}
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <button class="md:hidden" onClick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="p-2 text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 hover:bg-gray-50 rounded-lg p-2">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                    <svg class="w-5 h-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 py-2 bg-white rounded-lg shadow-xl border border-gray-100">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Profile
                                    </div>
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100 mt-2">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 px-6 py-8">
                @yield('seller_layout')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="max-w-7xl mx-auto py-4 px-6">
                    <p class="text-sm text-gray-500">&copy; {{ date('Y') }} E-Commerce Seller Dashboard. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
    @livewireScripts
</body>
</html>