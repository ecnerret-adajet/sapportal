<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('form_status_missing', function(Blueprint $table){
            $table->integer('form_status_id')->unsigned();
            $table->foreign('form_status_id')->references('id')
                ->on('form_statuses')->onDelete('cascade');
            $table->integer('missing_id')->unsigned();
            $table->foreign('missing_id')->references('id')
                ->on('missings')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('form_status_sapuser', function(Blueprint $table){
            $table->integer('form_status_id')->unsigned();
            $table->foreign('form_status_id')->references('id')
                ->on('form_statuses')->onDelete('cascade');
            $table->integer('sapuser_id')->unsigned();
            $table->foreign('sapuser_id')->references('id')
                ->on('sapusers')->onDelete('cascade');
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
        Schema::dropIfExists('form_status_sapuser');
        Schema::dropIfExists('form_status_missing');
        Schema::dropIfExists('form_statuses');
    }
}
