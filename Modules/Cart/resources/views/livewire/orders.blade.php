<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            @if(count($orders) > 0)
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="border rounded-lg p-4 bg-white shadow">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-semibold text-lg">Order #{{ $order->id }}</h3>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold">${{ number_format($order->total, 0) }}</p>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <h4 class="font-medium mb-2">Items:</h4>
                                <div class="space-y-2">
                                    @foreach($order->items as $item)
                                        <div class="flex justify-between text-sm">
                                            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                            <span>${{ number_format($item->product->price * $item->quantity, 0) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <p class="text-gray-600 mb-4">You haven't placed any orders yet.</p>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
