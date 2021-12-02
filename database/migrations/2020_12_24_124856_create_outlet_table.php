<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet', function (Blueprint $table) {
            
            $table->increments('outlet_id');
            $table->string('outlet_name')->unique();
            $table->decimal('outlet_lat',10,8);
            $table->decimal('outlet_long',11,8);
            $table->string('outlet_area');
            $table->string('outlet_city');
            $table->string('outlet_state');
            $table->string('outlet_country');
            $table->integer('is_active')->default(1);
            $table->string('is_assigned')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlet');
    }
}
