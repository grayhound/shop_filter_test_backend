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
        Schema::create('catalog_category_to_product_property_types', function (Blueprint $table) {
            $table->foreignUuid('catalog_category_id')->references('id')->on('catalog_categories');
            $table->foreignUuid('product_property_type_id')->references('id')->on('product_property_types');

            $table->primary(['catalog_category_id', 'product_property_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_category_to_product_property_types');
    }
};
