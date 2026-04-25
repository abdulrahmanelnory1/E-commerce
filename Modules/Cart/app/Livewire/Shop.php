<?php

namespace Modules\Cart\App\Livewire;

use Livewire\Component;
use Modules\Product\App\Models\Product;

class Shop extends Component
{
    public array $cart = [];
    public float $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

 
    private function loadCart()
    {
        $this->cart = session('cart', []);
        $this->calculateTotal();
    }


    private function saveCart()
    {
        session(['cart' => $this->cart]);
        $this->loadCart();
    }

    private function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function addToCart(int $productId, int $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        
        if (isset($this->cart[$product->id])) {
            $this->cart[$product->id]['quantity'] += $quantity;
        } else {
            $this->cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        $this->saveCart();
        $this->dispatch('item-added', name: $product->name);
    }

    public function updateQuantity(int $productId, int $quantity)
    {
        if (isset($this->cart[$productId])) {
            if ($quantity > 0) {
                $this->cart[$productId]['quantity'] = $quantity;
            } else {
                unset($this->cart[$productId]);
            }
            $this->saveCart();
        }
    }

    public function removeFromCart(int $productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            $this->saveCart();
        }
    }
    
    public function clearCart()
    {
        $this->cart = [];
        $this->saveCart();
    }

    public function render()
    {
        return view('cart::livewire.shop');
    }
}
