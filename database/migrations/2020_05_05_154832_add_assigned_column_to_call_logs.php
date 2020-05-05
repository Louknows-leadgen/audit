<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedColumnToCallLogs extends Migration
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
            $table->integer('team_code')->nullable();
            $table->integer('is_claimed')->default(0);
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
        Schema::table('calllogs', function (Blueprint $table) {
            //
            $table->dropColumn('team_code');
            $table->dropColumn('is_claimed');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
