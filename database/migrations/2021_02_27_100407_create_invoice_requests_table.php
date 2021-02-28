<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id')->references('id')->on('tasks')->cascadeOnDelete();              
            $table->boolean('RFQ')->default(0)->nullable();
            $table->string('quote')->nullable();
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
        Schema::dropIfExists('invoice_requests');
    }
}
