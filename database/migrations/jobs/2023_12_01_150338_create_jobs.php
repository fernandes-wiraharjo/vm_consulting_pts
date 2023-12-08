<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id_client');
            $table->integer('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('clients');
            $table->string('code', 50)->unique();
            $table->string('description', 250)->nullable();
            $table->string('status', 20)->default('open');
            $table->time('total_hours')->default(0);
            $table->integer('total_costs')->default(0);
            $table->boolean('is_active')->default(true);
            $table->index('created_by');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamp('created_date', $precision = 0);
            $table->index('updated_by');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamp('updated_date', $precision = 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
