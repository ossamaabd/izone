<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ClientId')->unsigned()->nullable();
            $table->foreign('ClientId')->references('id')->on('clients')->onDelete('cascade');
            $table->bigInteger('PriorityId')->unsigned()->nullable();
            $table->foreign('PriorityId')->references('id')->on('priorities')->onDelete('cascade');
            $table->bigInteger('StatusId')->unsigned()->nullable();
            $table->foreign('StatusId')->references('id')->on('statuses')->onDelete('cascade');
            $table->date('creation_date');
            $table->decimal('total_working_hours',12,2)->nullable();
            $table->text('work_report')->nullable();
            $table->date('work_completion_date')->nullable();
            $table->string("client's_notes")->nullable();
            $table->decimal("client's_evaluation",12,2)->nullable();
            $table->decimal('total_cost',12,2)->default(0);
            $table->bigInteger('ServiceId')->unsigned()->nullable();
            $table->foreign('ServiceId')->references('id')->on('Services')->onDelete('cascade');
            $table->boolean('IsDiscount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
