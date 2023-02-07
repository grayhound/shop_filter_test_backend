<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($catalog_category_id): JsonResponse
    {
        $products = Product::filters()->defaultSort('id')->paginate();

        $data = [
            'catalog_category_id' => $catalog_category_id,
            'products' => $products,
        ];

        return response()->json($data);
    }
}
