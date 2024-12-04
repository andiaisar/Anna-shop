@extends('admin.layouts.layout')
@section('admin_page_title')
    Order History Admin Dashboard
@section('admin-layout')
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-tr from-blue-50 via-white to-purple-50 py-8 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg transform transition-all duration-300 hover:scale-101 hover:shadow-lg" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-primary via-purple-600 to-primary-dark bg-clip-text text-transparent">
                    Order History
                </h2>
                <p class="mt-2 text-gray-600">Manage and track all orders</p>
            </div>
            
            <div class="space-y-8">
                @forelse ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 overflow-hidden border border-gray-100">
                        <div class="p-6">
                            <div class="flex flex-wrap justify-between items-center mb-6 border-b pb-4">
                                <div class="space-y-2">
                                    <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        {{ $order->invoice_number }}
                                    </h3>
                                    <p class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>

                                @php
                                    $statusColor = [
                                        'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-300 ring-yellow-600/20',
                                        'processing' => 'bg-blue-50 text-blue-700 border-blue-300 ring-blue-600/20',
                                        'shipped' => 'bg-purple-50 text-purple-700 border-purple-300 ring-purple-600/20',
                                        'delivered' => 'bg-green-50 text-green-700 border-green-300 ring-green-600/20',
                                        'cancelled' => 'bg-red-50 text-red-700 border-red-300 ring-red-600/20',
                                    ][$order->status];
                                @endphp
                                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $statusColor }} border ring-1 ring-inset">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-6 space-y-4 backdrop-blur-sm backdrop-filter">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                                        <p class="font-semibold text-gray-800">{{ strtoupper($order->payment_method) }}</p>
                                    </div>
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Shipping Cost</p>
                                        <p class="font-semibold text-gray-800">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Total Amount</p>
                                        <p class="font-bold text-xl text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button onclick="toggleItems('order-{{ $order->id }}')" 
                                        class="w-full text-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-300 flex items-center justify-center">
                                    <span>View Items</span>
                                    <svg class="w-5 h-5 ml-2 transform transition-transform duration-300" id="arrow-{{ $order->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                
                                <div id="order-{{ $order->id }}" class="hidden mt-6 space-y-4">
                                    @foreach ($order->orderItems as $item)
                                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                            <img src="{{ $item->product->image_url }}" 
                                                 alt="{{ $item->product->name }}"
                                                 class="w-20 h-20 object-cover rounded-lg shadow-md">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                                <p class="text-gray-600">
                                                    {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-primary">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl shadow-lg border border-gray-100">
                        <img src="https://illustrations.popsy.co/gray/box-empty.svg" class="w-60 h-60 mx-auto mb-6 opacity-75" alt="No orders">
                        <div class="text-gray-500 mb-8 text-lg">No orders found in the history</div>
                        <a href="{{ route('customer.products.index') }}" 
                           class="inline-flex items-center px-8 py-3 bg-primary text-white rounded-xl hover:bg-primary-dark transform transition-all duration-300 hover:scale-105 hover:shadow-lg gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleItems(id) {
            const element = document.getElementById(id);
            const arrow = document.getElementById('arrow-' + id.replace('order-', ''));
            element.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }
    </script>
    @endpush
</x-app-layout>

@endsection