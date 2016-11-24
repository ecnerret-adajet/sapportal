<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

         /**
         * Sap user creation approver status
         */

        Schema::create('approver_status', function (Blueprint $table) {
            $table->integer('approver_id')->unsigned();
            $table->foreign('approver_id')->references('id')
                ->on('approvers')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')
                ->on('statuses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('management_status', function (Blueprint $table) {
            $table->integer('management_id')->unsigned();
            $table->foreign('management_id')->references('id')
                ->on('managements')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')
                ->on('statuses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('functional_status', function(Blueprint $table) {
            $table->integer('functional_id')->unsigned();
            $table->foreign('functional_id')->references('id')
                ->on('functionals')->onDelete('cascade');
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
        Schema::dropIfExists('functional_status');
        Schema::dropIfExists('management_status');
        Schema::dropIfExists('approver_status');
        Schema::dropIfExists('statuses');
    }
}
