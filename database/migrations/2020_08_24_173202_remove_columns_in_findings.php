<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsInFindings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('findings', function (Blueprint $table) {
            //
            $table->dropColumn(['agnt_sys_issue','zt_lol','agent_dispo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('findings', function (Blueprint $table) {
            //
            $table->integer('agnt_sys_issue');
            $table->integer('zt_lol');
            $table->integer('agent_dispo');
        });
    }
}
