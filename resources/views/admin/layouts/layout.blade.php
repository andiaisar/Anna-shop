<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('admin_page_title') - Admin Panel</title>
    
    <!-- Tailwind CSS and Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#3730A3'
                    }
                }
            }
        }
    </script>
</head>

<body class="h-full" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" 
             class="fixed inset-0 z-20 bg-gray-900/50 lg:hidden"></div>

        <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
             class="fixed inset-y-0 left-0 z-30 w-64 transform overflow-y-auto bg-white border-r border-gray-200 p-4 transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            
            <!-- Logo -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('admin') }}" class="flex items-center space-x-2">
                    {{-- <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg> --}}
                    <span class="text-xl font-bold">Admin Panel</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('admin') ? 'bg-indigo-500 text-white shadow-lg shadow-indigo-200' : 'text-gray-600 hover:bg-indigo-50' }}">
                    <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('admin') ? 'bg-indigo-600' : 'bg-indigo-100' }} rounded-lg transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6 {{ request()->routeIs('admin') ? 'text-white' : 'text-indigo-600' }}" viewBox="0 0 24 24" fill="none">
                            <path d="M9 19V13C9 11.8954 8.10457 11 7 11H5C3.89543 11 3 11.8954 3 13V19C3 20.1046 3.89543 21 5 21H7C8.10457 21 9 20.1046 9 19Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M15 19V5C15 3.89543 14.1046 3 13 3H11C9.89543 3 9 3.89543 9 5V19C9 20.1046 9.89543 21 11 21H13C14.1046 21 15 20.1046 15 19Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M21 19V9C21 7.89543 20.1046 7 19 7H17C15.8954 7 15 7.89543 15 9V19C15 20.1046 15.8954 21 17 21H19C20.1046 21 21 20.1046 21 19Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </span>
                    <span class="ml-3">Dashboard</span>
                </a>

                <!-- User Section -->
                <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">User Management</p>
                    <a href="{{ route('users.create') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('users.create') ? 'bg-green-500 text-white shadow-lg shadow-green-200' : 'text-gray-600 hover:bg-green-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('users.create') ? 'bg-green-600' : 'bg-green-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('users.create') ? 'text-white' : 'text-green-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M16 18L18 20L22 16M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="ml-3">Create User</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium group rounded-lg {{ request()->routeIs('users.index') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none">
                            <path d="M17 7.82843V16.1716C17 16.702 16.7893 17.2107 16.4142 17.5858L13.5858 20.4142C13.2107 20.7893 12.702 21 12.1716 21H7.82843C6.76201 21 5.74015 20.5786 4.98959 19.8284L4.17157 19.0104C3.42101 18.2598 3 17.238 3 16.1716V7.82843C3 6.76201 3.42101 5.74015 4.17157 4.98959L4.98959 4.17157C5.74015 3.42101 6.76201 3 7.82843 3H12.1716C12.702 3 13.2107 3.21071 13.5858 3.58579L16.4142 6.41421C16.7893 6.78929 17 7.29799 17 7.82843Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9 13H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M9 9H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M9 17H13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Manage Users
                    </a>
                </div>

                <!-- Product Management Section -->
                <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Product Management</p>
                    <a href="{{ route('catagory.create') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->is('admin/category/create') ? 'bg-purple-500 text-white shadow-lg shadow-purple-200' : 'text-gray-600 hover:bg-purple-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->is('admin/category/create') ? 'bg-purple-600' : 'bg-purple-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->is('admin/category/create') ? 'text-white' : 'text-purple-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M12 9V15M15 12H9M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span class="ml-3">Create Category</span>
                    </a>
                    <a href="{{ route('catagory.manage') }}" 
                        class="flex items-center px-4 py-2.5 mt-2 text-sm font-medium transition-all duration-200 rounded-lg {{ request()->is('admin/category/manage') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Manage Categories
                    </a>

                    <!-- Sub Category -->
                    <a href="{{ route('subcatagory.create') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('subcatagory.create') ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'text-gray-600 hover:bg-amber-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('subcatagory.create') ? 'bg-amber-600' : 'bg-amber-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('subcatagory.create') ? 'text-white' : 'text-amber-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M12 10V14M14 12H10M19 10V14M21 12H17M7 8V16M5 10V14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </span>
                        <span class="ml-3">Create Sub Category</span>
                    </a>
                    <a href="{{ route('subcatagory.manage') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('subcatagory.manage') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Manage Sub Category
                    </a>
                    {{-- <a href="{{ route('productattribute.create') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('productattribute.*')?'bg-primary text-white':'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Create Attribute
                    </a>
                    <a href="{{ route('productattribute.manage') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('productattribute.*')?'bg-primary text-white':'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Manage Attribute
                    </a> --}}

                    <!-- Discount -->
                    {{-- <a href="{{ route('discount.create') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('discount.create') ? 'bg-rose-500 text-white shadow-lg shadow-rose-200' : 'text-gray-600 hover:bg-rose-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('discount.create') ? 'bg-rose-600' : 'bg-rose-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('discount.create') ? 'text-white' : 'text-rose-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M9.5 17L6 4M17.5 17L14 4M4 11.5H20M4 15.5H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span class="ml-3">Create Discount</span>
                    </a>
                    <a href="{{ route('discount.manage') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('discount.manage') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Manage Discount
                    </a>

                    <!-- Product Management -->
                    <a href="{{ route('product.manage') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('product.manage') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-200' : 'text-gray-600 hover:bg-emerald-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('product.manage') ? 'bg-emerald-600' : 'bg-emerald-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('product.manage') ? 'text-white' : 'text-emerald-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M20 7L12 3L4 7M20 7L12 11M20 7V17L12 21M12 11L4 7M12 11V21M4 7V17L12 21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </span>
                        <span class="ml-3">Manage Products</span>
                    </a> --}}
                </div>

                <!-- Reviews Section -->
                {{-- <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Reviews & Ratings</p>
                    <a href="{{ route('product.review.manage') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('product.review.manage') ? 'bg-blue-500 text-white shadow-lg shadow-blue-200' : 'text-gray-600 hover:bg-blue-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('product.review.manage') ? 'bg-blue-600' : 'bg-blue-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('product.review.manage') ? 'text-white' : 'text-blue-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </span>
                        <span class="ml-3">Manage Reviews</span>
                    </a>
                </div> --}}

                <!-- History Section -->
                {{-- <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Transaction History</p>
                    <a href="{{ route('admin.cart.history') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('admin.cart.history') ? 'bg-violet-500 text-white shadow-lg shadow-violet-200' : 'text-gray-600 hover:bg-violet-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('admin.cart.history') ? 'bg-violet-600' : 'bg-violet-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('admin.cart.history') ? 'text-white' : 'text-violet-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="ml-3">Cart History</span>
                    </a>

                    <a href="{{ route('admin.order.history') }}" 
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium transition-all duration-200 group rounded-lg {{ request()->routeIs('admin.order.history') ? 'bg-teal-500 text-white shadow-lg shadow-teal-200' : 'text-gray-600 hover:bg-teal-50' }}">
                        <span class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('admin.order.history') ? 'bg-teal-600' : 'bg-teal-100' }} rounded-lg transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6 {{ request()->routeIs('admin.order.history') ? 'text-white' : 'text-teal-600' }}" fill="none" viewBox="0 0 24 24">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="ml-3">Order History</span>
                    </a>
                </div> --}}

                <!-- Settings Section -->
                {{-- <div class="pt-4">
                    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.settings')?'bg-primary text-white':'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Settings
                    </a>
                </div> --}}
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Navigation -->
            <nav class="sticky top-0 z-10 bg-white border-b border-gray-200 backdrop-blur-sm bg-white/90">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <!-- Mobile menu button -->
                        <button @click="sidebarOpen = !sidebarOpen" type="button" 
                                class="lg:hidden p-2 text-gray-500 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <!-- Right Navigation -->
                        <div class="flex items-center space-x-6">
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="flex items-center space-x-3 hover:bg-gray-50 rounded-lg p-2 transition duration-200">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4F46E5&color=fff" 
                                         class="w-9 h-9 rounded-full border-2 border-primary shadow-md" 
                                         alt="{{ Auth::user()->name }}">
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">Administrator</p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
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
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50">
                                    
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                    </div>

                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span>My Profile</span>
                                        </div>
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 text-sm text-left text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                                <span>Sign Out</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1 overflow-auto bg-gray-50">
                <div class="py-6">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        @yield('admin-layout')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize Alpine.js components
        document.addEventListener('alpine:init', () => {
            // Add any Alpine.js component initialization here
        });
    </script>
</body>
</html>