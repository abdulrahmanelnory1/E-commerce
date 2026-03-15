<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected function cart(): array
    {
        return session('cart', []);
    }

    protected function saveCart(array $cart)
    {
        session(['cart' => $cart]);
    }

    public function index()
    {
        $cart = $this->cart();
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $quantity = max(1, (int)$request->input('quantity', 1));
        $cart = $this->cart();
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }
        $this->saveCart($cart);
        return redirect()->back()->with('success', 'Item added to cart');
    }

    public function update(Product $product, Request $request)
    {
        $quantity = (int)$request->input('quantity', 1);
        $cart = $this->cart();
        if (isset($cart[$product->id])) {
            if ($quantity > 0) {
                $cart[$product->id]['quantity'] = $quantity;
            } else {
                unset($cart[$product->id]);
            }
            $this->saveCart($cart);
        }
        return redirect()->route('cart.index');
    }

    public function remove(Product $product)
    {
        $cart = $this->cart();
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $this->saveCart($cart);
        }
        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $cart = $this->cart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
        ]);
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Order placed successfully');
    }
}
