<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindingZtpLolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finding_ztp_lols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('finding_id');
            $table->integer('z_t_p_l_o_l_id');
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
        Schema::dropIfExists('finding_ztp_lols');
    }
}
