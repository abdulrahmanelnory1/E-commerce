<?php

namespace Modules\Cart\App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Orders extends Component
{
    public array $orders = [];

    /**
     * Mount lifecycle hook - load user orders
     */
    public function mount()
    {
        $this->loadOrders();
    }

    /**
     * Load user's orders
     */
    private function loadOrders()
    {
        $this->orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Refresh orders list
     */
    public function refreshOrders()
    {
        $this->loadOrders();
    }

    public function render()
    {
        return view('cart::livewire.orders', [
            'orders' => Order::where('user_id', Auth::id())
                ->with('items.product')
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }
}
