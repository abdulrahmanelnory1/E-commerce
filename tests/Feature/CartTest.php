<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\SubCategory;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // create necessary models without factories
        $category = \App\Models\Category::create(['name' => 'TestCategory']);
        $sub = SubCategory::create(['name'=>'TestSub','category_id'=>$category->id]);
        Product::create([
            'name' => 'Sample',
            'price' => 100,
            'sub_category_id' => $sub->id,
            'quantity' => 5,
        ]);
    }

    public function test_authenticated_user_can_add_and_view_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::first();
        $response = $this->post(route('cart.add', $product), ['quantity' => 2]);
        $response->assertRedirect();
        $this->assertEquals(2, session('cart')[$product->id]['quantity']);

        $view = $this->get(route('cart.index'));
        $view->assertStatus(200);
        $view->assertSee('Sample');
    }

    public function test_cart_update_and_remove()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::first();
        $this->post(route('cart.add', $product), ['quantity' => 1]);
        $this->patch(route('cart.update', $product), ['quantity' => 3]);
        $this->assertEquals(3, session('cart')[$product->id]['quantity']);
        $this->delete(route('cart.remove', $product));
        $this->assertEmpty(session('cart'));
    }

    public function test_checkout_creates_order()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::first();
        $this->post(route('cart.add', $product), ['quantity' => 2]);
        $this->post(route('cart.checkout'));
        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);
        $order = \App\Models\Order::first();
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $this->assertEmpty(session('cart'));
    }
}
