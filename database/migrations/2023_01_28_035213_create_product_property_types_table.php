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
        Schema::create('product_property_types', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->enum('value_type', ['enum', 'number']);
            $table->string('value_name');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_property_types');
    }
};
