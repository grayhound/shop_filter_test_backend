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
        DB::enableQueryLog();
        // get catalog category (or fail)
        $catalogCategory = CatalogCategory::findOrFail($catalog_category_id);

        // get products for this category
        $products = $catalogCategory->products()->where('catalog_category_id', $catalog_category_id)
            ->filters()
            ->defaultSort('id')
            ->paginate(30);

        // get property types attached to the catalog category
        $propertyTypes = $catalogCategory->propertyTypes()->get();

        // Alright here's the deal...
        $products = $products->where('properties.id', '9870d8e4-6d1a-40f8-83f0-f327fc8a579b');
        // var_dump(dd($products));
        var_dump(DB::getQueryLog());
        DB::disableQueryLog();

        // End of the deal...

        // prepare data to return
        $data = [
            // 'catalog_category_id' => $catalog_category_id,
            'products' => $products,
            // 'property_types' => $propertyTypes,
        ];

        // And return data!
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
