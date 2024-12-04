@extends('customer.layouts.layout')
@section('customer-layout')

<div class="min-h-screen bg-gray-50 py-8 pt-24"> 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Order History</h1>
            <p class="text-gray-500">Track all your previous orders</p>
        </div>

        @if($orders->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No orders yet</h3>
                <p class="mt-1 text-gray-500">Start shopping to create your first order</p>
                <div class="mt-6">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                        Browse Products
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Order #{{ $order->invoice_number }}</h3>
                                    <p class="text-sm text-gray-500">
                                        Placed on {{ $order->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="px-4 py-2 rounded-full text-sm font-semibold
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'shipped' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </div>
                            </div>

                            <div class="border-t border-gray-200 mt-4 pt-4">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center py-4 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                        @if($item->product->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                                                 alt="{{ $item->product->product_name }}" 
                                                 class="h-20 w-20 object-cover rounded">
                                        @endif
                                        <div class="ml-4 flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $item->product->product_name }}</h4>
                                            <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                            <p class="text-sm font-medium text-gray-900">
                                                Rp{{ number_format($item->price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-200 mt-4 pt-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Shipping</span>
                                    <span class="text-gray-900">${{ number_format($order->shipping_cost, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm font-medium mt-2">
                                    <span class="text-gray-900">Total</span>
                                    <span class="text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
