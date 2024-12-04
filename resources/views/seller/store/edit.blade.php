@extends('seller.layouts.layout')
@section('seller_page_title')
    Edit Store
@endsection
@section('seller_layout')
    <div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white backdrop-blur-lg bg-opacity-90 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 transform transition-all hover:scale-[1.01]">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h5 class="text-xl font-semibold text-gray-700">Edit Store</h5>
                </div>
                <div class="p-6">
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                            <div class="flex items-center">
                                <svg class="h-6 w-6 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-red-700">Oops! Something went wrong:</p>
                                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
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
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-green-700"><strong>Success!</strong> {{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('update.store', $store_info) }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="store_name" class="text-sm font-medium text-gray-700">Store Name</label>
                                <input type="text" name="store_name" id="store_name" value="{{ $store_info->store_name }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="space-y-2">
                                <label for="store_phone" class="text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="store_phone" id="store_phone" value="{{ $store_info->store_phone }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="space-y-2">
                                <label for="slug" class="text-sm font-medium text-gray-700">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ $store_info->slug }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="space-y-2">
                                <label for="store_description" class="text-sm font-medium text-gray-700">Store Description</label>
                                <textarea name="store_description" id="store_description" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ $store_info->store_description }}</textarea>
                            </div>

                            <div class="space-y-2">
                                <label for="store_address" class="text-sm font-medium text-gray-700">Store Address</label>
                                <input type="text" name="store_address" id="store_address" value="{{ $store_info->store_address }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-all duration-200 hover:scale-105 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Update Store
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection