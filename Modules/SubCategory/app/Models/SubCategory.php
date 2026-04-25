<?php

namespace Modules\SubCategory\App\Models;
use Modules\Product\App\Models\Product;
use Modules\Category\App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['name', 'category_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
