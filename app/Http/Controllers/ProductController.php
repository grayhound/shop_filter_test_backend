<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use App\Models\ProductPropertyType;
use App\Models\ProductToProductProperty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list($catalog_category_id): JsonResponse
    {
        // get catalog category (or fail)
        $catalogCategory = CatalogCategory::findOrFail($catalog_category_id);

        // get property types attached to the catalog category
        $propertyTypes = $catalogCategory->propertyTypes()->get();

        // get filters from request
        $filters = Request()->get('filter');

        // get products for this category
        $products = $this->__getProducts($catalog_category_id, $propertyTypes, $filters);

        // prepare data to return
        $data = [
            'catalog_category_id' => $catalog_category_id,
            'products' => $products->paginate(30),
            'property_types' => $propertyTypes
        ];

        // And return data!
        return response()->json($data);
    }

    private function __getProducts($catalog_category_id, $propertyTypes, $filters)
    {
        $products = Product::select('products.id', 'products.name', 'products.price')
            ->filters()
            ->where('catalog_category_id', $catalog_category_id)
            ->defaultSort('name');

        $filtersQueries = $this->__getFiltersQuery($propertyTypes, $filters);

        // if we have queries for filters - make a join with this subquery
        if (count($filtersQueries)) {
            $filtersQueriesSql = $this->__prepareIntersectionSqlFromQuerys($filtersQueries);
            $products->joinSub($filtersQueriesSql, 'filters', function ($join) {
                $join->on('filters.product_id', '=', 'products.id');
            });
        }

        return $products;
    }

    /**
     * Get list of queries to filter by properties.
     */
    private function __getFiltersQuery($propertyTypes, $filters)
    {
        $queries = [];
        foreach ($propertyTypes as $propertyType) {
            if (array_key_exists($propertyType->id, $filters)) {
                $query = ProductToProductProperty::select('product_id')
                                                 ->where('product_property_type_id', $propertyType->id)
                                                 ->whereIn('product_property_id', $filters[$propertyType->id]);
                $queries[] = $query;
            }
        }

        return $queries;
    }

    private function __prepareIntersectionSqlFromQuerys($filtersQueries)
    {
        $prepareSqlQueries = [];
        foreach ($filtersQueries as $filterQuery)  {
            $sqlQuery = $filterQuery->toSqlWithBindings();
            $prepareSqlQueries[] = $sqlQuery;
        }

        return join(' INTERSECT ', $prepareSqlQueries);

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
