<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetserversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetservers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

         Schema::create('missing_targetserver', function(Blueprint $table){
            $table->integer('missing_id')->unsigned();
            $table->foreign('missing_id')->references('id')
                    ->on('missings')
                    ->onDelete('cascade');

            $table->integer('targetserver_id')->unsigned();
            $table->foreign('targetserver_id')->references('id')
                    ->on('targetservers')
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
        Schema::dropIfExists('missing_targetserver');
        Schema::dropIfExists('targetservers');
    }
}
