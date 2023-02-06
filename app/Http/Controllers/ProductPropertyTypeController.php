<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPropertyTypeRequest;
use App\Http\Requests\UpdateProductPropertyTypeRequest;
use App\Models\ProductPropertyType;

class ProductPropertyTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreProductPropertyTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPropertyTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPropertyType $productPropertyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPropertyType $productPropertyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductPropertyTypeRequest  $request
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductPropertyTypeRequest $request, ProductPropertyType $productPropertyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductPropertyType  $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPropertyType $productPropertyType)
    {
        //
    }
}
