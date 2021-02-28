<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantyRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id')->references('id')->on('tasks')->cascadeOnDelete();               
            $table->string('reason');
            $table->string('software');
            $table->string('firmware');            
            $table->string('brand');
            $table->string('model');
            $table->string('serial');
            $table->date('start');
            $table->date('end');
            $table->foreignId('Address')->references('id')->on('site_addresses')->cascadeOnDelete();  
            $table->string('L2')->nullable();
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
        Schema::dropIfExists('warranty_repairs');
    }
}
