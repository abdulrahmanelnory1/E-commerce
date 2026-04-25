<?php

namespace Modules\Category\App\Http\Controllers;

use Modules\Category\App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category::category.index', compact('categories'));
    }
}
