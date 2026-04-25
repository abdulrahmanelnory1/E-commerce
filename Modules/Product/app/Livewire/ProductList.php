<?php

namespace Modules\Product\App\Livewire;

/**
 * Livewire can ONLY access public properties.
 * Public properties are automatically available in your Blade view.
 * 
*/
use Livewire\Component;
use Modules\SubCategory\App\Models\SubCategory;
use Modules\Product\App\Models\Product;

class ProductList extends Component
{
    public string $search = '';
    public SubCategory $subCategory;

    /**
     * called once when the component is initialized.
     * called before the component is rendered for the first time.
     * accept parameters from routes.
     * Used for initializing properties.
     * can not return anything.
     * find() returns null if not found
     * findOrFail() throws an exception if not found, which is  good for user experience.
     */
    public function mount(SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
    }
    /**
     * Add product to cart
     */
    public function addToCart(int $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        
        session(['cart' => $cart]);
        $this->dispatch('item-added', name: $product->name);
    }

     /**
     * Called after mounting the component.
     * called every time search property is updated, unlike mount which is called only once.
     * Returns the view that represents the component.
     * Must return a view.
     * Accept parameters from routes.
     * Called automatically by Livewire.
     */
    public function render()
    {
        $products = $this->subCategory->products()// returns a query builder instance.
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%'.$this->search.'%')
            )
            ->get();// this is what returns the collection of products.

        return view('product::livewire.product-list', compact('products'));
    }
}
