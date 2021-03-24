<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignPreferenceDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_preference_dispositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assign_preference_id');
            $table->integer('disposition_id');
            $table->integer('count');

            $table->timestamps();

            // $table->foreign('assign_preference_id')
            //       ->references('id')->on('assign_preferences')
            //       ->onDelete('cascade');

            // $table->foreign('disposition_id')
            //       ->references('id')->on('dispositions')
            //       ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_preference_dispositions');
    }
}
