<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->text('description');
            $table->integer('user_id_create')->references('id')->on('users');
            $table->integer('user_id_lastupdate')->references('id')->on('users');
            $table->integer('user_id_worker')->references('id')->on('users');
            $table->dateTime('deadline');
            $table->enum('status', ['WAITING', 'ACTIVE', 'DONE'])->nullable(false)->default('WAITING');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
