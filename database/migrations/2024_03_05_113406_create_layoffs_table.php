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
        Schema::create('layoffs', function (Blueprint $table) {
            $table->id();

            $table->date('start_period');//fecha inicio Periodo Liquidacion
            $table->date('end_period');//fecha fin Periodo Liquidacion
            $table->integer('layoff_days');//Numero de dias de Liquidacion
            $table->decimal('layoff_value');//Valor devengado de Cesantias
            $table->decimal('layoff_interest', 10,2);//Intereses de Cesantias
            $table->enum('pay_layoffs', ['pay', 'causation'])->default('pay'); //modo de pago

            $table->foreignId('payroll_acrued_id')->constrained();
            $table->foreignId('payroll_partial_acrued_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layoffs');
    }
};
