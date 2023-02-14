<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use Illuminate\Http\JsonResponse;

class CatalogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(): JsonResponse
    {
        $catalogCategories = CatalogCategory::all();

        $data = [
            'catalog_categories' => $catalogCategories,
        ];

        return response()->json($data);
    }
}
