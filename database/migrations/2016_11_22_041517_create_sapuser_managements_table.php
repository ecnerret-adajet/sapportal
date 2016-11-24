<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSapuserManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapuser_managements', function (Blueprint $table) {
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

        Schema::create('sapuser_management_status', function(Blueprint $table) {
            $table->integer('sapuser_management_id')->unsigned();
            $table->foreign('sapuser_management_id')->references('id')
                ->on('sapuser_managements')->onDelete('cascade');
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
        Schema::dropIfExists('sapuser_management_status');
        Schema::dropIfExists('sapuser_managements');
    }
}
