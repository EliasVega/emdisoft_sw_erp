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
        Schema::create('payroll_partials', function (Blueprint $table) {
            $table->id();

            $table->string('year_month',7);//año y mes de liquidacion
            $table->date('start_date');//fecha inicio liquidacion
            $table->date('end_date');//fecha fin de liquidacion
            $table->date('payment_date');//fecha de realizacion de los pagos
            $table->date('generation_date');//fecha generacion nomina
            $table->integer('days');//dias trabajados
            $table->decimal('total_acrued', 20,4);//total devengado
            $table->enum('fortnight', ['first', 'second'])->default('first');//diferenciacion de nomina
            $table->string('note')->nullable();//observaciones
            $table->integer('vacation_days');//dias vacaciones disfrutadas
            $table->integer('inability_days');//dias de incapacidad
            $table->integer('license_days');//dias de licencia

            $table->foreignId('employee_id')->constrained();
            $table->foreignId('payroll_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_partials');
    }
};
