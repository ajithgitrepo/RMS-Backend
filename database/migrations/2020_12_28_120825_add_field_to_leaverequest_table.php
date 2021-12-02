<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToLeaverequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('leaverequest', function (Blueprint $table) {
            
            $table->string('action_by')->nullable()->after('is_rejected');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaverequest', function (Blueprint $table) {
           
            $table->dropColumn('action_by');
        });
    }
}
