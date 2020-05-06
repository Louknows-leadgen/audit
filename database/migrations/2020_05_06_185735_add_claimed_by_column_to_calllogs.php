<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClaimedByColumnToCalllogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calllogs', function (Blueprint $table) {
            //
            $table->integer('claimed_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calllogs', function (Blueprint $table) {
            //
            $table->dropColumn('claimed_by');
        });
    }
}
