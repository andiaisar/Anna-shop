<div class="space-y-4 p-4 bg-white rounded-lg shadow-sm">
    <div class="relative">
        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">
            Select Category
        </label>
        <select 
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 ease-in-out"
            name="category_id" 
            wire:model.live="selectedCategory"
        >
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="relative">
        <label for="subcategory_id" class="block text-sm font-semibold text-gray-700 mb-1">
            Select Subcategory
        </label>
        <select 
            name="subcategory_id" id="subcategory_id"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 ease-in-out"
            class="subcategory_id" 
            wire:model.live="selectedSubcategory"
        >
            <option value="">Select Subcategory</option>
            @if(!is_null($subcategories))
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

