<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordingScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording_scripts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('script_code')->nullable();
            $table->integer('recording_id')->nullable();
            $table->string('cust_statement')->nullable();
            $table->integer('acknowledgement')->nullable();
            $table->string('agent_resp')->nullable();
            $table->integer('agent_resp_spd')->nullable();
            $table->string('cust_dtl')->nullable();
            $table->string('agent_input')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('recording_scripts');
    }
}
