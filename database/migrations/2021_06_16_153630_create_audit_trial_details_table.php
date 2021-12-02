<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditTrialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trial_details', function (Blueprint $table) {
             // $table->string('id')->primary();
                $table->increments('id');
             //    $table->string('title');
                 $table->date('date');
                 $table->time('time');
                 $table->string('ip_address');
                 $table->string('country');
                 $table->text('description');
                 $table->string('status');
                 $table->string('device');
                 $table->unsignedInteger('role_id');
                 $table->string('created_by');
                 $table->timestamps();
                 $table->foreign('created_by')->references('employee_id')->on('employee');
                 $table->foreign('role_id')->references('id')->on('roles');
             });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_trial_details');
    }
}
