<?php

namespace Modules\SubCategory\App\Http\Controllers;
use Modules\Category\App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Category $category)
    {
        $subCategories = $category->subCategories;
        return view('subcategory::subcategories.index', compact('subCategories', 'category'));
    }
}
