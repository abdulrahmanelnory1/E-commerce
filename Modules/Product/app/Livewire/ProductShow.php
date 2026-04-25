<?php

namespace Modules\Product\App\Livewire;

use Livewire\Component;
use Modules\Product\App\Models\Product;

class ProductShow extends Component
{
    public Product $product;
    public int $quantity = 1;

    public function mount(Product $product)
    {
        $this->product = $product->load('images', 'subCategory.category');
    }

    public function addToCart()
    {
        $this->dispatch('add-to-cart', productId: $this->product->id, quantity: $this->quantity);
        $this->dispatch('item-added', name: $this->product->name);
    }

    public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('product::livewire.product-show');
    }
}