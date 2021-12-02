<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('leave_rule', function (Blueprint $table) {
         
            $table->increments('leave_rule_id');
            $table->string('leave_type');
            $table->string('total_days');
            $table->string('year');
            $table->string('requirements');
            $table->string('remarks');
            $table->string('is_active')->default('1');
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
        //
    }
}
