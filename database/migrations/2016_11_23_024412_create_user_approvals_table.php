<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('missing_id')->unsigned();
            $table->foreign('missing_id')->references('id')
                ->on('missings')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('approver_user', function (Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('approver_id')->unsigned();
            $table->foreign('approver_id')->references('id')
                ->on('approvers')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('functional_user', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('functional_id')->unsigned();
            $table->foreign('functional_id')->references('id')
                ->on('functionals')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('management_user', function(Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('management_id')->unsigned();
            $table->foreign('management_id')->references('id')
                ->on('managements')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('sapuser_user', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('sapuser_id')->unsigned();
            $table->foreign('sapuser_id')->references('id')
                ->on('sapusers')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('sapuser_approver_user', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('sapuser_approver_id')->unsigned();
            $table->foreign('sapuser_approver_id')->references('id')
                ->on('sapuser_approvers')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('sapuser_functional_user', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('sapuser_functional_id')->unsigned();
            $table->foreign('sapuser_functional_id')->references('id')
                ->on('sapuser_functionals')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('sapuser_management_user', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('sapuser_management_id')->unsigned();
            $table->foreign('sapuser_management_id')->references('id')
                ->on('sapuser_managements')->onDelete('cascade');
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
        Schema::dropIfExists('sapuser_management_user');
        Schema::dropIfExists('sapuser_functional_user');
        Schema::dropIfExists('sapuser_approver_user');
        Schema::dropIfExists('sapuser_user');
        Schema::dropIfExists('management_user');
        Schema::dropIfExists('functional_user');
        Schema::dropIfExists('approver_user');
        Schema::dropIfExists('missing_user');
    }
}
