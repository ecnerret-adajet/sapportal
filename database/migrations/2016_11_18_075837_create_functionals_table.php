<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('missing_id')->unsigned()->nullable();
            $table->integer('sapuser_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('comment');
            $table->timestamp('approved_date');

            $table->foreign('missing_id')->references('id')
                ->on('missings')->onDelete('cascade');
            $table->foreign('sapuser_id')->references('id')
                ->on('sapusers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('functionals');
    }
}
