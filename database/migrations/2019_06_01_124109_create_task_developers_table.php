<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_developers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manager_id');
            $table->unsignedInteger('developer_id');
            $table->unsignedInteger('task_id');
            $table->string('task_status');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('developer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_developers');
    }
}
