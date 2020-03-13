<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_add_id')->unsigned();
            $table->foreign('user_add_id')->references('id')->on('users');
            $table->integer('user_do_id')->unsigned();
            $table->foreign('user_do_id')->references('id')->on('users');
            $table->string('task');
            $table->text('notes');
            $table->integer('status')->default(1);
            $table->integer('priority');
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
        Schema::dropIfExists('tasks');
    }
}
