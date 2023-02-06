<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_to_product_properties', function (Blueprint $table) {
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->foreignUuid('product_property_type_id')->references('id')->on('product_property_types');
            $table->foreignUuid('product_property_id')->references('id')->on('product_properties');

            $table->primary(['product_id', 'product_property_type_id', 'product_property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_to_product_properties');
    }
};
