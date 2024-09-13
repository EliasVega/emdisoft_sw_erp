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
        Schema::create('provision_partials', function (Blueprint $table) {
            $table->id();

            $table->string('year_month',7);//año y mes de liquidacion
            $table->date('start_period');//fecha inicio Periodo provision
            $table->date('end_period');//fecha fin Periodo provision
            $table->integer('vacation_days');//dias de vacaciones
            $table->decimal('vacations', 20,3);//Vacaciones
            $table->integer('bonus_days');//dias de prima
            $table->decimal('bonus', 20,3);//Primas
            $table->integer('layoff_days');//dias de cesantias
            $table->decimal('layoffs', 20,3);//Cesantias
            $table->decimal('layoff_interest', 20,3);//Intereses de Cesantias
            $table->decimal('vacation_adjustment', 20,3);//ajuste del valor de vacaciones
            $table->enum('status',['pendient', 'canceled', 'caused'])->default('pendient');

            $table->foreignId('provision_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payroll_acrued_id')->constrained();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');//para los json

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provision_partials');
    }
};
