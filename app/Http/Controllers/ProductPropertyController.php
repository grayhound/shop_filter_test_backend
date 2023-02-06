<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPropertyRequest;
use App\Http\Requests\UpdateProductPropertyRequest;
use App\Models\ProductProperty;

class ProductPropertyController extends Controller
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
     * @param  \App\Http\Requests\StoreProductPropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPropertyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductProperty  $productProperty
     * @return \Illuminate\Http\Response
     */
    public function show(ProductProperty $productProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductProperty  $productProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductProperty $productProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductPropertyRequest  $request
     * @param  \App\Models\ProductProperty  $productProperty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductPropertyRequest $request, ProductProperty $productProperty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductProperty  $productProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductProperty $productProperty)
    {
        //
    }
}
