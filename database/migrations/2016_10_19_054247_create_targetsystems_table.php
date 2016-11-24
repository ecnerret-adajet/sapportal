<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetsystems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('missing_targetsystem', function(Blueprint $table){
            $table->integer('missing_id')->unsigned();
            $table->foreign('missing_id')->references('id')
                ->on('missings')
                ->onDelete('cascade');

            $table->integer('targetsystem_id')->unsigned();
            $table->foreign('targetsystem_id')->references('id')
                ->on('targetsystems')
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
        Schema::dropIfExists('missing_targetsystem');
        Schema::dropIfExists('targetsystems');
    }
}
