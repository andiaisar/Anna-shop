@extends('admin.layouts.layout')
@section('admin_page_title')
    Manage Category Dashboard
@endsection
@section('admin-layout')
    <div class="p-4 sm:p-6">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Categories Management</h1>
                <a href="{{ route('catagory.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    <i class="bi bi-plus-lg mr-2"></i>Add Category
                </a>
            </div>
            <p class="mt-2 text-gray-600">Manage your product categories</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                <div class="flex items-center">
                    <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total Categories: {{ $categories->count() }}</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categories as $cat)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cat->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                            <i class="bi bi-grid text-indigo-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $cat->category_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600 truncate max-w-xs">{{ $cat->category_description }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($cat->category_image)
                                        <img src="{{ asset('storage/' . $cat->category_image) }}" alt="{{ $cat->category_name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('show.cat', $cat->id) }}" 
                                       class="inline-flex items-center px-3 py-2 border border-indigo-600 rounded-md text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                                        <i class="bi bi-pencil-square mr-2"></i>Edit
                                    </a>
                                    <form action="{{ route('delete.cat', $cat->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 border border-red-600 rounded-md text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="bi bi-trash mr-2"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200">
                <!-- Add pagination here if needed -->
            </div>
        </div>
    </div>
@endsection