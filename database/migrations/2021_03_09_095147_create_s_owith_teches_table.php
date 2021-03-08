<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSOwithTechesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_owith_teches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id')->references('id')->on('tasks')->cascadeOnDelete();    
            $table->foreignId('support_types_id')->references('id')->on('support_types')->cascadeOnDelete();              
            $table->boolean('warranty');       
            $table->string('quote')->nullable();    
            $table->boolean('device_disposal'); 
            $table->string('device_name');        
            $table->foreignId('device_type')->references('id')->on('device_types')->cascadeOnDelete();    
            $table->boolean('LTstatus');    
            $table->string('issue');              
            $table->foreignId('reason')->references('id')->on('replacement_reasons')->cascadeOnDelete();    
            $table->boolean('connection_type')->nullable();   
            $table->string('wifi_name')->nullable();     
            $table->string('wifi_password')->nullable();         
            $table->boolean('network_type')->nullable();  
            $table->string('IP')->nullable();
            $table->string('subnet')->nullable();
            $table->string('DG')->nullable();
            $table->string('DNS')->nullable();
            $table->string('DNS2')->nullable();
            $table->boolean('SevenEleven')->nullable();
            $table->string('store_id')->nullable();
            $table->string('postcode')->nullable();         
            $table->string('passcode')->nullable();
            $table->foreignId('application')->references('id')->on('applications')->cascadeOnDelete();    
            $table->boolean('matrox')->nullable();
            $table->foreignId('solution_type')->references('id')->on('solution_types')->cascadeOnDelete();    
            $table->boolean('orientation')->nullable();
            $table->string('screen_model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('end')->nullable();
            $table->tinyInteger('network_device_type')->nullable();
            $table->string('projector_model')->nullable();
            $table->string('projector_lamp')->nullable();
            $table->longText('notes');
            $table->foreignId('Address')->references('id')->on('site_addresses')->cascadeOnDelete();  
            $table->string('L2');
            $table->boolean('display_status')->default('0');
            $table->tinyInteger('techs_required')->nullable();
            $table->longText('job');
            $table->longText('tools');
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
        Schema::dropIfExists('s_owith_teches');
    }
}
