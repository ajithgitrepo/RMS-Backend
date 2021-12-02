<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
             	$table->increments("id");
           	$table->string('sku');
            	$table->string('product_name');
             	$table->integer('barcode');
              	$table->integer('uom');
              	$table->integer('zrep_code');
              	$table->integer('piece_per_carton');
            	$table->integer('price_per_piece');
            	$table->string('updated_by');
            	$table->string('created_by');
            	$table->unsignedInteger('brand_id');
            	$table->unsignedInteger('client_id');
            	$table->unsignedInteger('product_categories');
            	$table->string('remarks');
            	
            	$table->string('is_active')->default('1'); 
            	$table->timestamps();
            
            	$table->foreign('brand_id')->references('id')->on('brand_details');
            	$table->foreign('product_categories')->references('id')->on('category_details');
                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
