<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatalogCategoryRequest;
use App\Http\Requests\UpdateCatalogCategoryRequest;
use App\Models\CatalogCategory;

class CatalogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCatalogCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatalogCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatalogCategory  $catalogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CatalogCategory $catalogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatalogCategory  $catalogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CatalogCategory $catalogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCatalogCategoryRequest  $request
     * @param  \App\Models\CatalogCategory  $catalogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatalogCategoryRequest $request, CatalogCategory $catalogCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatalogCategory  $catalogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatalogCategory $catalogCategory)
    {
        //
    }
}
