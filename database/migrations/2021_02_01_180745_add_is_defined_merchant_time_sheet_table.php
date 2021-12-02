<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDefinedMerchantTimeSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('merchant_time_sheet', function (Blueprint $table) {

            $table->string('is_defined')->default('0')->after('date');

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
            $table->dropColumn(['is_defined']);
        });
    }
}
