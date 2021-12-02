<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifiationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifiation_details', function (Blueprint $table) {
           // $table->string('id')->primary();
           $table->increments('id');
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->string('created_by');
            $table->string('user_type');
            $table->string('created_to');
          //  $table->string('created_to');
            $table->string('read_at')->default('0');
             $table->string('page_url', 500);
            $table->integer('is_active');
            $table->timestamps();
            $table->foreign('created_by')->references('employee_id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifiation_details');
    }
}
