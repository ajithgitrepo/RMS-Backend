<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantTimeSheetIdOutletLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('outlet_login', function (Blueprint $table) {

            $table->unsignedInteger('timesheet_id')->nullable()->after('outlet_id');

            $table->foreign('timesheet_id')->references('id')->on('merchant_time_sheet');

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlet_login', function (Blueprint $table) {
            $table->dropColumn(['timesheet_id']);
        });
    }
}
