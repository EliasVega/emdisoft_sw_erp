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

            $table->date('start_period');//fecha inicio Periodo provision
            $table->date('end_period');//fecha fin Periodo provision
            $table->decimal('vacations', 10,2);//Vacaciones
            $table->decimal('bonus', 10,2);//Primas
            $table->decimal('layoffs', 10,2);//Cesantias
            $table->decimal('layoff_interest', 10,2);//Intereses de Cesantias
            $table->decimal('vacation_adjustment', 10,2);//ajuste del valor de vacaciones
            $table->enum('status',['pendient', 'canceled'])->default('pendient');

            $table->foreignId('provision_id')->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('provision_partials');
    }
};
