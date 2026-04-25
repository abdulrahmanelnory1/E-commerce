<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(count($cart) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Order Summary -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                        <div class="border rounded p-4">
                            @foreach($cart as $item)
                                <div class="flex justify-between py-2 border-b">
                                    <div>
                                        <p class="font-medium">{{ $item['name'] }}</p>
                                        <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <p class="font-medium">${{ number_format($item['price'] * $item['quantity'], 0) }}</p>
                                </div>
                            @endforeach
                            <div class="flex justify-between py-4 text-lg font-semibold">
                                <span>Total:</span>
                                <span>${{ number_format($total, 0) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Checkout Actions -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Complete Order</h3>
                        <div class="border rounded p-4">
                            <p class="text-sm text-gray-600 mb-4">
                                Click the button below to complete your purchase.
                            </p>
                            <button wire:click="processCheckout" 
                                    wire:loading.attr="disabled"
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 disabled:bg-gray-400">
                                <span wire:loading.remove>Place Order</span>
                                <span wire:loading>Processing...</span>
                            </button>
                            <a href="{{ route('shop.index') }}" class="block text-center mt-2 text-blue-600 hover:text-blue-800">
                                Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p class="text-gray-600 mb-4">Your cart is empty.</p>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    @script
    <script>
        Livewire.on('checkout-success', (data) => {
            alert('Order placed successfully! Order ID: ' + data.orderId);
            window.location.href = '{{ route("shop.orders") }}';
        });

        Livewire.on('checkout-empty', () => {
            window.location.href = '{{ route("shop.index") }}';
        });
    </script>
    @endscript
</x-app-layout>
