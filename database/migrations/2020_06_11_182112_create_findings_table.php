<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('findings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('recording_id');
            $table->integer('agent_dispo');
            $table->integer('correct_dispo');
            $table->string('agnt_sys_issue');
            $table->string('zt_lol');
            $table->integer('gen_obsrv');
            $table->text('qa_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('findings');
    }
}
