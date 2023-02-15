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

        $products = Product::search()
            ->where('catalog_category_id', $catalog_category_id)
            ->paginate(30);

        // prepare data to return
        $data = [
            'catalog_category_id' => $catalog_category_id,
            'products' => $products,
        ];

        // And return data!
        return response()->json($data);
    }
}
