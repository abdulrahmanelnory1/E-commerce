<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Category\App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Image;

class EcommerceSeeder extends Seeder
{
  
    public function run(): void
    {
        // Create categories
        $electronics = Category::create(['name' => 'Electronics']);
        $clothing = Category::create(['name' => 'Clothing']);
        $books = Category::create(['name' => 'Books']);

        // Create subcategories
        $phones = SubCategory::create(['name' => 'Smartphones', 'category_id' => $electronics->id]);
        $laptops = SubCategory::create(['name' => 'Laptops', 'category_id' => $electronics->id]);
        $shirts = SubCategory::create(['name' => 'Shirts', 'category_id' => $clothing->id]);
        $fiction = SubCategory::create(['name' => 'Fiction', 'category_id' => $books->id]);

        // Create products
        $iphone = Product::create([
            'name' => 'iPhone 15',
            'price' => 999.99,
            'description' => 'Latest iPhone with advanced features.',
            'quantity' => 10,
            'sub_category_id' => $phones->id
        ]);

        $macbook = Product::create([
            'name' => 'MacBook Pro',
            'price' => 1999.99,
            'description' => 'Powerful laptop for professionals.',
            'quantity' => 5,
            'sub_category_id' => $laptops->id
        ]);

        $tshirt = Product::create([
            'name' => 'Cotton T-Shirt',
            'price' => 19.99,
            'description' => 'Comfortable cotton t-shirt.',
            'quantity' => 50,
            'sub_category_id' => $shirts->id
        ]);

        $novel = Product::create([
            'name' => 'The Great Gatsby',
            'price' => 12.99,
            'description' => 'Classic American novel.',
            'quantity' => 20,
            'sub_category_id' => $fiction->id
        ]);

        // Create images (assuming files exist in public/images/)
        Image::create(['product_id' => $iphone->id, 'path' => 'iphone.jpg']);
        Image::create(['product_id' => $iphone->id, 'path' => 'iphone2.jpg']);
        Image::create(['product_id' => $macbook->id, 'path' => 'macbook.jpg']);
        Image::create(['product_id' => $tshirt->id, 'path' => 'tshirt.jpg']);
        Image::create(['product_id' => $novel->id, 'path' => 'book.jpg']);
    }
}
