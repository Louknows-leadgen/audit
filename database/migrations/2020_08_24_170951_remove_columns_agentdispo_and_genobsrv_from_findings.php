<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsAgentdispoAndGenobsrvFromFindings extends Migration
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
            $table->dropColumn(['correct_dispo','gen_obsrv','agnt_sys_issue','zt_lol']);
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
            $table->integer('correct_dispo');
            $table->integer('gen_obsrv');
            $table->string('agnt_sys_issue');
            $table->string('zt_lol');
        });
    }
}
