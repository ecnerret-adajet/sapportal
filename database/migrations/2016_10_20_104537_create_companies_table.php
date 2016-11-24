<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('company_sapuser', function(Blueprint $table){
            $table->integer('sapuser_id')->unsigned();
            $table->foreign('sapuser_id')->references('id')
                ->on('sapusers')
                ->onDelete('cascade');
            $table->integer('company_id')->references('id')
                ->on('companies')
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
        Schema::dropIfExists('company_sapuser');
        Schema::dropIfExists('companies');
    }
}
