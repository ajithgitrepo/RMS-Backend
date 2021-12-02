<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelieverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reliever', function (Blueprint $table) {
            $table->increments("id");
            $table->string("employee_id");
            $table->string('role');
            $table->string('reliever_id');
             $table->date('from_date');
            $table->date('to_date'); 
            $table->string('reason');
            $table->string("outlet_id");
            $table->string('is_approved')->default('0');
            $table->string('is_active')->default('1');
            $table->string('created_by');

            $table->timestamps();



            $table->foreign('employee_id')->references('employee_id')->on('employee');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reliever');
    }
}
