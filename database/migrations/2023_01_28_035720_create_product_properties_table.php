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
        Schema::create('product_properties', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('value');
            $table->float('value_number');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->primary('id');
            $table->foreignUuid('product_property_type_id')->references('id')->on('product_property_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_properties');
    }
};
