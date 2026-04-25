<?php

use Illuminate\Support\Facades\Route;
use Modules\SubCategory\App\Http\Controllers\SubCategoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('subcategories', SubCategoryController::class)->names('subcategory');
});
