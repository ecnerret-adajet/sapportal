<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSapusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapusers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('requested_by');
            $table->timestamp('requested_date')->nullable();
            $table->string('target_client');
            $table->string('sap_username');
            $table->string('first_name');
            $table->string('middle_initial');
            $table->string('last_name');
            $table->string('email');
            $table->string('tel_num');
            $table->string('user_role');
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
            $table->text('requested_comment');
            $table->foreign('user_id')->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('sapuser_targetserver', function(Blueprint $table){
            $table->integer('targetserver_id')->unsigned();
            $table->foreign('targetserver_id')->references('id')
                    ->on('targetservers')
                    ->onDelete('cascade');

            $table->integer('sapuser_id')->unsigned();
            $table->foreign('sapuser_id')->references('id')
                    ->on('sapusers')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('sapuser_targetserver');
        Schema::dropIfExists('sapusers');
    }
}
