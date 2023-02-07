<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use App\Models\ProductPropertyType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($catalog_category_id, Request $request): JsonResponse
    {
        // Redis::flushDb();

        $data_json = Redis::get('api:product_controller:'.$catalog_category_id);
        if ($data_json) {
            $data = json_decode($data_json);
        } else {
            $catalogCategory = CatalogCategory::findOrFail($catalog_category_id);

            $propertyTypes = $catalogCategory->propertyTypes()->get();

            $products = Product::where('catalog_category_id', $catalog_category_id)
                ->with('properties')
                ->filters()
                ->defaultSort('id')
                ->paginate(30);

            $data = [
                'catalog_category_id' => $catalog_category_id,
                'property_types' => $propertyTypes,
                'products' => $products,
            ];

            Redis::set('api:product_controller:'.$catalog_category_id, json_encode($data), 'EX', 300);

        }

        return response()->json($data);
    }
}
