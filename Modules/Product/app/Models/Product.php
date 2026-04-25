<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\SubCategory\App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    protected $fillable = ['name','price','description','quantity','sub_category_id','image'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
