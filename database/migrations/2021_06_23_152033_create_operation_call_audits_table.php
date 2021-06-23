<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationCallAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_call_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ctr');
            $table->dateTime('timestamp');
            $table->string('user', 20);
            $table->string('user_group', 100)->nullable();
            $table->string('audit_type', 50);
            $table->string('phone_number', 20);
            $table->string('recording_id', 20);
            $table->string('recording_filename', 100)->nullable();
            $table->string('recording_url', 150)->nullable();
            $table->string('server_ip', 20);
            $table->string('server_origin', 30)->nullable();
            $table->string('campaign', 20);
            $table->string('dispo', 20);
            $table->string('talk_time', 20);
            $table->string('server_source', 30)->nullable();
            $table->integer('team_code')->nullable();
            $table->integer('is_claimed');
            $table->integer('claimed_by');
            $table->integer('status');
            $table->integer('ops_user');
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
        Schema::dropIfExists('operation_call_audits');
    }
}
