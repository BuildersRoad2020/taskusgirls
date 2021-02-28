<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('case');
            $table->string('store');
            $table->foreignId('task_types_id')->references('id')->on('task_types')->cascadeOnDelete();              
            $table->foreignId('users_id')->references('id')->on('users')->cascadeOnDelete();  
            $table->integer('admin')->nullable();
            $table->boolean('status')->default('0')->nullable();
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
