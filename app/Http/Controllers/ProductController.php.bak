<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use App\Models\ProductToProductProperty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Show product for catalog category.
     * And show property types for this category.
     *
     * @param string $catalog_category_id
     *
     * @return JsonResponse
     */
    public function list($catalog_category_id): JsonResponse
    {
        // get catalog category (or fail)
        $catalogCategory = CatalogCategory::findOrFail($catalog_category_id);

        // get property types attached to the catalog category
        $propertyTypes = $catalogCategory->propertyTypes()->get();

        // get filters from request
        $filters = Request()->get('filter', []);

        // get products for this category
        $products = $this->__getProducts($catalog_category_id, $propertyTypes, $filters);

        // attach counts to the propertyTypes
        $propertyTypes = $this->__attachProductCountToPropertyTypes($catalog_category_id, $propertyTypes, $filters);

        // prepare data to return
        $data = [
            'catalog_category_id' => $catalog_category_id,
            'property_types' => $propertyTypes,
            'products' => $products->paginate(30),
        ];

        // And return data!
        return response()->json($data);
    }

    /**
     * Get filtered products. This will return
     *
     * @param string $catalog_category_id
     * @param Collection $propertyTypes
     * @param array $filters
     *
     * @return Builder
     */
    private function __getProducts($catalog_category_id, $propertyTypes, $filters)
    {
        $productsQuery = Product::select('products.id', 'products.name', 'products.price')
            ->filters()
            ->where('catalog_category_id', $catalog_category_id)
            ->defaultSort('name');

        $filtersQueries = $this->__getFiltersQuery($propertyTypes, $filters);

        $productsQuery = $this->__attachFilterIntersectionSqlToProductQuery($productsQuery, $filtersQueries);

        return $productsQuery;
    }

    /**
     * Get filtered products. This will return
     *
     * @param string $catalog_category_id
     * @param Collection $propertyTypes
     * @param array $filters
     *
     * @return Builder
     */
    private function __getProductsCountQuery($catalog_category_id, $propertyTypes, $filters)
    {
        $productsQuery = Product::select(DB::raw('count(products.id) as products_count, status'))
            ->where('catalog_category_id', $catalog_category_id);

        $filtersQueries = $this->__getFiltersQuery($propertyTypes, $filters);

        $productsQuery = $this->__attachFilterIntersectionSqlToProductQuery($productsQuery, $filtersQueries);

        return $productsQuery;
    }

    /**
     * Attach join subquery to the main product query.
     *
     * @param Builder $productQuery
     * @param mixed $filtersQueries
     *
     * @return Builder
     */
    private function __attachFilterIntersectionSqlToProductQuery($productsQuery, $filtersQueries)
    {
        // if we have queries for filters - make a join with this subquery
        if (count($filtersQueries)) {
            $filtersQueriesSql = $this->__prepareIntersectionSqlFromQuerys($filtersQueries);
            $productsQuery->joinSub($filtersQueriesSql, 'filters', function ($join) {
                $join->on('filters.product_id', '=', 'products.id');
            });
        }

        return $productsQuery;
    }

    /**
     * Get list of queries to filter by properties.
     *
     * @param Collection $propertyTypes
     * @param array $filters
     *
     * @return array
     */
    private function __getFiltersQuery($propertyTypes, $filters)
    {
        $queries = [];
        foreach ($propertyTypes as $propertyType) {
            if (array_key_exists($propertyType->id, $filters)) {
                $query = $this->__getSingleFilterQuery($propertyType->id, $filters[$propertyType->id]);
                $queries[] = $query;
            }
        }

        return $queries;
    }

    /**
     * Prepare a single query to filter by property type and list of selected properties.
     *
     * @param string $propertyTypeId
     * @param array $propertyIds
     *
     * @return string
     */
    private function __getSingleFilterQuery($propertyTypeId, $propertyIds)
    {
        $query = ProductToProductProperty::select('product_id')
            ->where('product_property_type_id', $propertyTypeId)
            ->whereIn('product_property_id', $propertyIds);
        return $query;
    }

    /**
     * Вообще весьма странно, что есть UNION, а INTERSECT приходится имитировать.
     *
     * Ну да ладно, что я, SQL не объединю.
     *
     * Вспомнил же как фильтры делать.
     *
     * @param array $filtersQueries
     * @return string
     */
    private function __prepareIntersectionSqlFromQuerys($filtersQueries)
    {
        $prepareSqlQueries = [];
        foreach ($filtersQueries as $filterQuery)  {
            $sqlQuery = $filterQuery->toSqlWithBindings();
            $prepareSqlQueries[] = $sqlQuery;
        }

        return join(' INTERSECT ', $prepareSqlQueries);

    }

    private function __attachProductCountToPropertyTypes($catalog_category_id, $propertyTypes, $filters)
    {
        $updatedPropertyTypes = $propertyTypes;

        foreach ($updatedPropertyTypes as $propertyTypeIndex => $propertyType) {
            if ($propertyType->value_type === 'enum') {
                $propertyIds = $propertyType->properties->pluck('id');
                foreach ($propertyIds as $propertyIndex => $propertyId) {
                    $emulatedFilters = [
                        $propertyType->id => [$propertyId],
                    ];
                    $productsCount = $this->__getProducts($catalog_category_id, $propertyTypes, $emulatedFilters)->count();
                    $updatedPropertyTypes[$propertyTypeIndex]->properties[$propertyIndex]->setProductCount($productsCount);
                }
            }
        }

        return $updatedPropertyTypes;
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
