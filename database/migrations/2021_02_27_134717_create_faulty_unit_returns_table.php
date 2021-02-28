<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaultyUnitReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faulty_unit_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id')->references('id')->on('tasks')->cascadeOnDelete();  
            $table->foreignId('Address')->references('id')->on('site_addresses')->cascadeOnDelete(); 
            $table->longText('Notes');   
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
        Schema::dropIfExists('faulty_unit_returns');
    }
}
