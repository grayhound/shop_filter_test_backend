<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($catalog_category_id, Request $request): JsonResponse
    {
        $catalogCategory = CatalogCategory::findOrFail($catalog_category_id);

        $products = Product::where('catalog_category_id', $catalog_category_id)
            ->filters()
            ->defaultSort('id')
            ->paginate(30);

        $data = [
            'catalog_category_id' => $catalog_category_id,
            'products' => $products,
        ];

        return response()->json($data);
    }
}
