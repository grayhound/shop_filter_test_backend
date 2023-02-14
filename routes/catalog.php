<?php

use App\Http\Controllers\CatalogCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/catalog',
    [CatalogCategoryController::class, 'list'],
  )
  ->name('catalog_categories');

Route::get(
    '/catalog/{catalog_category_id}/products',
    [ProductController::class, 'list'],
  )
  ->name('catalog_products')
  ->whereUuid('catalog_category_id');
