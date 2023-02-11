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
    public function list($catalog_category_id): JsonResponse
    {
        $catalogCategory = CatalogCategory::findOrFail($catalog_category_id);

        $products = Product::where('catalog_category_id', $catalog_category_id)
            ->filters()
            ->defaultSort('id')
            ->paginate(30);

        $propertyTypes = $catalogCategory->propertyTypes()->get();

        // var_dump($propertyTypes[0]->correctProperties()->get);
        // die();

        $data = [
            'catalog_category_id' => $catalog_category_id,
            'property_types' => $propertyTypes,
            'products' => $products,
        ];

        return response()->json($data);
    }

    // redis
    /**
     * Redis::flushDb();
     *
     * $data_json = Redis::get('api:product_controller:'.$catalog_category_id);
     *
     * Redis::set('api:product_controller:'.$catalog_category_id, json_encode($data), 'EX', 300);
     */
}
