<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutletLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlet_login', function (Blueprint $table) {

            $table->string('checkin_location')->nullable()->after('checkout_time');
            $table->string('checkout_location')->nullable()->after('checkout_time');

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
            $table->dropColumn(['checkin_location']);
            $table->dropColumn(['checkout_location']);
        });
    }
}
