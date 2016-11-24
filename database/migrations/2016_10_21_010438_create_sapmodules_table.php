<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSapmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing sapmodule
        Schema::create('sapmodules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // Create table for associating sapmodule to users (Many-to-Many)
        Schema::create('sapmodule_user', function (Blueprint $table){
            $table->integer('sapmodule_id')->unsigned();
            $table->foreign('sapmodule_id')->references('id')
                ->on('sapmodules')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Create table for associating sapmodule to sapuser (Many-to-Many)
        Schema::create('sapmodule_sapuser', function (Blueprint $table){
            $table->integer('sapmodule_id')->unsigned();
            $table->foreign('sapmodule_id')->references('id')
                ->on('sapmodules')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('sapuser_id')->unsigned();
            $table->foreign('sapuser_id')->references('id')
                ->on('sapusers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sapmodule_sapuser');
        Schema::dropIfExists('sapmodule_user');
        Schema::dropIfExists('sapmodules');
    }
}
