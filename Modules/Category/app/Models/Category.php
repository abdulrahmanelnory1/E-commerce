<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\SubCategory\App\Models\SubCategory;

class Category extends Model
{
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    protected $fillable = ['name'];
}
