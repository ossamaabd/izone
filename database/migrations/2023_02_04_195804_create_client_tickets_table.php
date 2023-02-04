<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ClientId')->unsigned();
            $table->foreign('ClientId')->references('id')->on('clients')->onDelete('cascade');
            $table->bigInteger('TicketId')->unsigned();
            $table->foreign('TicketId')->references('id')->on('tickets')->onDelete('cascade');
            $table->decimal('evaluation',12,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_tickets');
    }
}
