@extends('customer.layouts.layout')
@section('customer-layout')

<div class="container mx-auto px-4 py-8 min-h-screen bg-gray-50 pt-24">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Shopping Cart</h1>
        <span class="text-sm text-gray-600">{{ count($cartItems) }} items</span>
    </div>

    @if(count($cartItems) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <!-- Select All Section -->
                <div class="bg-white p-4 rounded-lg shadow-sm mb-4 flex items-center">
                    <input type="checkbox" id="selectAll" class="form-checkbox h-5 w-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <label for="selectAll" class="ml-3 text-gray-700 font-medium">Select All Items</label>
                </div>

                @foreach($cartItems as $item)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-4 hover:shadow-md transition-all duration-300" id="cart-item-{{ $item->id }}">
                        <div class="p-6 flex flex-col md:flex-row gap-6">
                            <!-- Checkbox -->
                            <div class="flex items-center">
                                <input type="checkbox" name="cart_items[]" value="{{ $item->id }}" 
                                    class="cart-item-checkbox form-checkbox h-5 w-5 text-green-600 rounded border-gray-300 focus:ring-green-500"
                                    data-price="{{ $item->product->regular_price }}"
                                    data-id="{{ $item->id }}"
                                    data-product-id="{{ $item->product_id }}"> 
                            </div>
                            
                            <!-- Product Image -->
                            <div class="md:w-1/4">
                                <img src="{{ asset('storage/'.$item->product->images->first()->image_path) }}" alt="{{ $item->name }}" 
                                     class="w-full h-48 object-cover rounded-lg shadow-sm hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-2 hover:text-green-600 transition-colors">
                                        {{ $item->product->product_name }}
                                    </h2>
                                    <div class="text-sm text-gray-500 mb-4">SKU: {{ $item->product->id }}</div>
                                </div>

                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <span class="text-2xl font-bold text-green-600" id="price-{{ $item->id }}">
                                        Rp {{ number_format($item->product->regular_price * $item->quantity, 0, ',', '.') }}
                                    </span>
                                    
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center border border-gray-200 rounded-lg shadow-sm">
                                            <button type="button" class="px-4 py-2 text-gray-600 hover:bg-gray-50 transition-colors decrease-qty" data-id="{{ $item->id }}">-</button>
                                            <input type="number" value="{{ $item->quantity }}" 
                                                   class="w-16 text-center border-x border-gray-200 py-2 focus:outline-none quantity-input"
                                                   data-id="{{ $item->id }}"
                                                   data-price="{{ $item->product->regular_price }}"
                                                   min="1">
                                            <button type="button" class="px-4 py-2 text-gray-600 hover:bg-gray-50 transition-colors increase-qty" data-id="{{ $item->id }}">+</button>
                                        </div>

                                        <form action="{{ route('cart.destroy', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="flex items-center gap-2 text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg transition-all duration-300">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Remove</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Selected Items</span>
                            <span id="selected-items-count">0</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span id="shipping">Rp 15.000</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span id="total" class="text-green-600">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="total_amount" id="total-amount-input">
                        <input type="hidden" name="shipping_cost" value="15000">
                        <div id="selected-items-container"></div>
                        
                        <!-- Payment method selection -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Payment Method</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" value="transfer" id="transfer" class="form-radio h-4 w-4 text-green-600" checked>
                                    <label for="transfer" class="ml-2 text-gray-700">Bank Transfer</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" value="cod" id="cod" class="form-radio h-4 w-4 text-green-600">
                                    <label for="cod" class="ml-2 text-gray-700">Cash on Delivery (COD)</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="checkout-button" 
                                class="w-full bg-green-600 text-white py-4 rounded-lg font-semibold hover:bg-green-700 transform hover:-translate-y-1 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                            Proceed to Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg shadow-sm border border-gray-200">
            <i class="fas fa-shopping-cart text-5xl text-gray-400 mb-4"></i>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Your cart is empty</h2>
            <p class="text-gray-600 mb-6">Looks like you haven't added any items to your cart yet.</p>
            {{-- <a href="#" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                Continue Shopping
            </a> --}}
        </div>
    @endif
</div>

<script>
// Add this helper function at the top
function formatRupiah(number) {
    return 'Rp ' + number.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&.');
}

let total = 0;

document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.getElementsByClassName('cart-item-checkbox');
    for (let checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
    updateOrderSummary();
});

document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateOrderSummary);
});

document.querySelectorAll('.increase-qty').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
        input.value = parseInt(input.value) + 1;
        updateItemPrice(id);
        updateOrderSummary();
    });
});

document.querySelectorAll('.decrease-qty').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateItemPrice(id);
            updateOrderSummary();
        }
    });
});

document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const id = this.dataset.id;
        if (parseInt(this.value) < 1) this.value = 1;
        updateItemPrice(id);
        updateOrderSummary();
    });
});

function updateItemPrice(id) {
    const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
    const price = parseFloat(input.dataset.price);
    const quantity = parseInt(input.value);
    const totalPrice = price * quantity;
    document.getElementById(`price-${id}`).textContent = formatRupiah(totalPrice);
}

function updateOrderSummary() {
    const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
    const selectedCount = selectedItems.length;
    document.getElementById('selected-items-count').textContent = selectedCount;
    
    let subtotal = 0;
    selectedItems.forEach(item => {
        const id = item.dataset.id;
        const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
        const price = parseFloat(input.dataset.price);
        const quantity = parseInt(input.value);
        subtotal += price * quantity;
    });

    // Fixed shipping cost in Rupiah
    const shipping = selectedCount > 0 ? 15000 : 0;
    const total = subtotal + shipping;

    // Update the order summary with Rupiah format
    document.getElementById('subtotal').textContent = formatRupiah(subtotal);
    document.getElementById('shipping').textContent = formatRupiah(shipping);
    document.getElementById('total').textContent = formatRupiah(total);

    // Enable/disable checkout button
    const checkoutButton = document.getElementById('checkout-button');
    checkoutButton.disabled = selectedCount === 0;

    // Add this new code at the end of updateOrderSummary function
    const totalAmountInput = document.getElementById('total-amount-input');
    totalAmountInput.value = total;

    // Update selected items container
    const selectedItemsContainer = document.getElementById('selected-items-container');
    selectedItemsContainer.innerHTML = '';
    selectedItems.forEach(item => {
        const id = item.dataset.id;
        const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
        const quantity = parseInt(input.value);
        
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'items[]';
        hiddenInput.value = JSON.stringify({
            cart_id: id,
            quantity: quantity,
            product_id: item.dataset.productId 
        });
        selectedItemsContainer.appendChild(hiddenInput);
    });
}

// Initial calculation
updateOrderSummary();
</script>

@endsection