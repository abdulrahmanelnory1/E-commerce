<?php

namespace Modules\Product\App\Http\Controllers;
use Modules\SubCategory\App\Models\SubCategory;
use Modules\Product\App\Models\Product;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    public function index(SubCategory $subCategory)
    {
        $products = $subCategory->products;
        return view('product::products.index', compact('products', 'subCategory'));
    }

    public function show(Product $product)
    {
        $product->load('images', 'subCategory.category');
        return view('product::products.show', compact('product'));
    }
}
