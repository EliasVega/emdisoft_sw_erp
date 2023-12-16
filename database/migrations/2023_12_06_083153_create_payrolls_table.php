<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');//fecha inicio liquidacion
            $table->date('end_date');//fecha fin de liquidacion
            $table->date('payment_date');//fecha de realizacion de los pagos
            $table->date('generation_date');//fecha generacion nomina
            $table->integer('days');//dias trabajados

            $table->foreignId('employee_id')->constrained();
            $table->foreignId('payment_frecuency_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
