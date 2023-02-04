<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicianTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('TechnicianId')->unsigned();
            $table->foreign('TechnicianId')->references('id')->on('technicians')->onDelete('cascade');
            $table->bigInteger('TicketId')->unsigned();
            $table->foreign('TicketId')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technician_tickets');
    }
}
