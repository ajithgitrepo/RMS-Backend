<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDefinedOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('outlet', function (Blueprint $table) {

            $table->integer('is_defined')->nullable()->after('outlet_country');

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('outlet', function (Blueprint $table) {
            $table->dropColumn(['is_defined']);
        });
    }
}
