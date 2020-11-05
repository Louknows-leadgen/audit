<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScriptResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('script_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recording_id');
            $table->integer('script_id');
            $table->string('cust_statement')->nullable();
            $table->string('aud_comment')->nullable();
            $table->string('inc_tagging')->nullable();
            $table->string('inapp_resp')->nullable();
            $table->string('inc_detail')->nullable();
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
        Schema::dropIfExists('script_responses');
    }
}
