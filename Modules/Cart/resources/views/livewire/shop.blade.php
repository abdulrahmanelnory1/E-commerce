<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(count($cart) > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">{{ __('Product') }}</th>
                            <th class="pb-2">{{ __('Price') }}</th>
                            <th class="pb-2">{{ __('Quantity') }}</th>
                            <th class="pb-2">{{ __('Subtotal') }}</th>
                            <th class="pb-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item['name'] }}</td>
                                <td class="py-2">${{ number_format($item['price'], 0) }}</td>
                                <td class="py-2">
                                    <input type="number" 
                                           value="{{ $item['quantity'] }}" 
                                           min="1" 
                                           class="w-16 border p-1"
                                           wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)" />
                                </td>
                                <td class="py-2">${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                                <td class="py-2">
                                    <button wire:click="removeFromCart({{ $item['id'] }})" 
                                            class="text-red-600 hover:text-red-800">
                                        {{ __('Remove') }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 text-right">
                    <p class="text-lg font-semibold">{{ __('Total') }}: ${{ number_format($total, 0) }}</p>
                    <div class="mt-4 space-x-2">
                        <button wire:click="clearCart" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                            {{ __('Clear Cart') }}
                        </button>
                        <a href="{{ route('shop.checkout') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 inline-block">
                            {{ __('Proceed to Checkout') }}
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p class="text-gray-600 mb-4">{{ __('Your cart is empty.') }}</p>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
