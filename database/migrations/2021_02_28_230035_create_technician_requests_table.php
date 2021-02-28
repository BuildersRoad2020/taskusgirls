<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicianRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id')->references('id')->on('tasks')->cascadeOnDelete();  
            $table->string('warranty')->default('0')->nullable();
            $table->string('quote')->nullable();
            $table->boolean('device_disposal');
            $table->string('device_name');
            $table->boolean('LTstatus');
            $table->tinyInteger('techs_required');
            $table->longText('job');
            $table->string('issue');
            $table->foreignId('Address')->references('id')->on('site_addresses')->cascadeOnDelete(); 
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
        Schema::dropIfExists('technician_requests');
    }
}
