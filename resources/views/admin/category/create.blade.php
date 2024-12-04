@extends('admin.layouts.layout')
@section('admin_page_title')
    Create Category Dashboard
@endsection
@section('admin-layout')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all hover:shadow-xl">
            <div class="px-8 py-6 bg-gradient-to-r from-green-600 to-green-700 border-b">
                <h5 class="text-2xl font-bold text-white tracking-wide">Create New Category</h5>
            </div>
            <div class="p-8">
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                            </svg>
                            <div>
                                <p class="font-medium text-red-800">Please fix the following errors:</p>
                                <ul class="mt-2 ml-4 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('store.cat') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div class="group">
                            <label for="category_name" class="block text-sm font-semibold text-gray-700 mb-2 group-hover:text-indigo-600 transition-colors">
                                Category Name
                            </label>
                            <input type="text" 
                                name="category_name" 
                                id="name" 
                                class="w-full rounded-lg border-2 border-gray-200 p-3 text-gray-700 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-300 hover:border-green-300"
                                placeholder="Enter Category Name">
                        </div>
                        
                        <div class="group">
                            <label for="category_description" class="block text-sm font-semibold text-gray-700 mb-2 group-hover:text-indigo-600 transition-colors">
                                Category Description
                            </label>
                            <input type="text" 
                                name="category_description" 
                                id="name" 
                                class="w-full rounded-lg border-2 border-gray-200 p-3 text-gray-700 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-300 hover:border-green-300"
                                placeholder="Enter Category Description">
                        </div>

                        <div class="group">
                            <label for="category_image" class="block text-sm font-semibold text-gray-700 mb-2 group-hover:text-indigo-600 transition-colors">
                                Category Image
                            </label>
                            <input type="file" 
                                name="category_image" 
                                id="category_image" 
                                class="w-full rounded-lg border-2 border-gray-200 p-3 text-gray-700 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-300 hover:border-green-300">
                        </div>

                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 px-6 rounded-lg font-semibold hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection