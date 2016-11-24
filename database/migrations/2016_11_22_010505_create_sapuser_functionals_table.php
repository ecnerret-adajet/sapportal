<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSapuserFunctionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapuser_functionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('sapuser_id')->unsigned()->nullable();

            $table->string('name');
            $table->text('comment');
            $table->timestamp('approved_date');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('sapuser_id')->references('id')
                ->on('sapusers')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('sapuser_functional_status', function(Blueprint $table){
            $table->integer('sapuser_functional_id')->unsigned();
            $table->foreign('sapuser_functional_id')->references('id')
                ->on('sapuser_functionals')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')
                ->on('statuses')->onDelete('cascade');
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
        Schema::dropIfExists('sapuser_functional_status');
        Schema::dropIfExists('sapuser_functionals');
    }
}
