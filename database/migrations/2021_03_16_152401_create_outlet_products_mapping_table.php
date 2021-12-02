<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletProductsMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_products_mapping', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('outlet_id');
            $table->unsignedInteger('brand_id');
            $table->string('is_active')->default(1);
            $table->timestamps();

            $table->foreign('outlet_id')->references('outlet_id')->on('outlet');
            $table->foreign('brand_id')->references('id')->on('brand_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlet_products_mapping');
    }
}
