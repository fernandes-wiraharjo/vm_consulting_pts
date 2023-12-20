<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id_role');
            $table->integer('id_role')->unsigned()->nullable();
            $table->foreign('id_role')->references('id')->on('roles');
            $table->index('id_position');
            $table->integer('id_position')->unsigned()->nullable();
            $table->foreign('id_position')->references('id')->on('positions');
            $table->string('name', 50);
            $table->string('user_name', 50)->unique();
            $table->string('password', 250);
            $table->integer('default_rate_per_hour');
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
        Schema::dropIfExists('users');
    }
}
