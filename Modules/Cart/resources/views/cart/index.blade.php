<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 text-red-600">{{ session('error') }}</div>
            @endif

            @if(count($cart) > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Product</th>
                            <th class="pb-2">Price</th>
                            <th class="pb-2">Quantity</th>
                            <th class="pb-2">Subtotal</th>
                            <th class="pb-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item['name'] }}</td>
                                <td class="py-2">${{ number_format($item['price'],0) }}</td>
                                <td class="py-2">
                                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border p-1" />
                                        <button type="submit" class="ml-1 text-blue-600">Update</button>
                                    </form>
                                </td>
                                <td class="py-2">${{ number_format($item['price'] * $item['quantity'],0) }}</td>
                                <td class="py-2">
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 text-right">
                    <p class="text-lg font-semibold">Total: ${{ number_format($total,0) }}</p>
                    <form action="{{ route('cart.checkout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Checkout</button>
                    </form>
                </div>
            @else
                <p class="text-center text-gray-600">Your cart is empty.</p>
            @endif
        </div>
    </div>
</x-app-layout>
