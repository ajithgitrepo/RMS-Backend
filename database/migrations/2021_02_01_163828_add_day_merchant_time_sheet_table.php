<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDayMerchantTimeSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_time_sheet', function (Blueprint $table) {

            $table->string('day')->nullable()->after('date');

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_time_sheet', function (Blueprint $table) {
            $table->dropColumn(['day']);
        });
    }
}
