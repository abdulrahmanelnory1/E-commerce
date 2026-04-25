<?php

namespace Modules\Cart\App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public array $cart = [];
    public float $total = 0;

    /**
     * Mount lifecycle hook - initialize checkout
     */
    public function mount()
    {
        $this->loadCart();
        
        if (empty($this->cart)) {
            $this->dispatch('checkout-empty');
        }
    }

    /**
     * Load cart from session
     */
    private function loadCart()
    {
        $this->cart = session('cart', []);
        $this->calculateTotal();
    }

    /**
     * Calculate total cart value
     */
    private function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    /**
     * Process checkout and create order
     */
    public function processCheckout()
    {
        if (empty($this->cart)) {
            $this->addError('cart', 'Your cart is empty.');
            return;
        }

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $this->total,
            ]);

            foreach ($this->cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            session()->forget('cart');
            
            $this->dispatch('checkout-success', orderId: $order->id);
            
        } catch (\Exception $e) {
            $this->addError('checkout', 'An error occurred during checkout. Please try again.');
        }
    }

    public function render()
    {
        return view('cart::livewire.checkout');
    }
}
