<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(SubCategory $subCategory)
    {
        $products = $subCategory->products;
        return view('products.index', compact('products', 'subCategory'));
    }

    public function show(Product $product)
    {
        $product->load('images', 'subCategory.category');
        return view('products.show', compact('product'));
    }
}
