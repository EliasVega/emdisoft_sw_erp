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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();

            $table->date('start_period');//fecha inicio periodo de vacaciones
            $table->date('end_period');//fecha fin periodo de vacaciones
            $table->date('start_vacations');//fecha inicio vacaciones
            $table->date('end_vacations');//fecha fin de vacaciones
            $table->integer('vacation_days');//cantidad de dias para esta typo
            $table->decimal('value_day', 10,2);//valor del dia
            $table->decimal('vacation_value', 10,2);//valor de vacaciones
            $table->enum('pay_mode', ['pay', 'causation'])->default('pay'); //modo de pago
            $table->enum('type',['enjoyed', 'compensated'])->default('enjoyed');//typo de vacaciones disfrutadas o compensadas

            $table->foreignId('payroll_acrued_id')->constrained();
            $table->foreignId('payroll_partial_acrued_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
