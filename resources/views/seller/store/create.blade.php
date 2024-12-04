@extends('seller.layouts.layout')
@section('seller_page_title')
    Create New Store
@endsection
@section('seller_layout')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8 bg-opacity-50 backdrop-blur-sm">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform hover:scale-[1.01] transition-all duration-300">
                <!-- Header -->
                <div class="px-6 py-8 bg-gradient-to-r from-green-600 to-green-700 relative overflow-hidden">
                    <div class="absolute inset-0 bg-grid-white/[0.1] bg-[size:16px_16px]"></div>
                    <h2 class="text-3xl font-bold text-white relative z-10 flex items-center gap-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Create Your Store
                    </h2>
                    <p class="text-blue-100 mt-2">Fill in the details below to set up your new store</p>
                </div>

                <!-- Alert Messages -->
                @if($errors->any())
                    <div class="p-4 m-4 bg-red-50 border-l-4 border-red-500 rounded-md">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-red-800">Please fix the following errors:</h3>
                                <ul class="mt-2 list-disc list-inside text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="p-4 m-4 bg-green-50 border-l-4 border-green-500 rounded-md">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Store Creation Form -->
                <form action="{{ route('create.store') }}" method="POST" class="p-8" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-8">
                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 group-hover:text-blue-600 transition-colors" for="store_name">
                                        Store Name
                                    </label>
                                    <input type="text" name="store_name" id="store_name" 
                                        class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white focus:bg-white"
                                        required placeholder="Enter your store name">
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 group-hover:text-blue-600 transition-colors" for="store_phone">
                                        Store Phone
                                    </label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </span>
                                        <input type="tel" name="store_phone" id="store_phone"
                                            class="block w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white focus:bg-white"
                                            required placeholder="Enter store contact number">
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="store_description">
                                    Store Description
                                </label>
                                <textarea name="store_description" id="store_description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required placeholder="Describe your store"></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="store_address">
                                    Store Address
                                </label>
                                <textarea name="store_address" id="store_address" rows="2"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required placeholder="Enter store address"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="store_logo">
                                    Store Logo
                                </label>
                                <input type="file" name="store_logo" id="store_logo"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    accept="image/*">
                                <p class="mt-1 text-sm text-gray-500">Recommended size: 200x200px</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="slug">
                                    Store Slug
                                </label>
                                <input type="text" name="slug" id="slug"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required placeholder="Enter store slug">
                                <p class="mt-1 text-sm text-gray-500">Example: my-store (use lowercase and hyphens only)</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-100">
                            <button type="submit" 
                                class="group relative w-full flex items-center justify-center py-4 px-6 text-lg font-medium rounded-xl text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-all duration-200 hover:scale-[1.02] shadow-lg hover:shadow-xl">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-6 w-6 text-blue-300 group-hover:text-blue-200 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </span>
                                Create Store
                                <span class="absolute right-0 inset-y-0 flex items-center pr-3">
                                    <svg class="h-6 w-6 text-blue-300 group-hover:text-blue-200 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection