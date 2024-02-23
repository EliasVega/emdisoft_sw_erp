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
        Schema::create('payroll_partial_acrueds', function (Blueprint $table) {
            $table->id();

            $table->decimal('salary', 10,2);//salario asignado
            $table->decimal('transport_assistance',10,2);//auxilio de trasporte
            $table->decimal('overtime',10,2)->default(0);//horas extras
            $table->decimal('vacations',10,2)->default(0);//vacaciones
            $table->decimal('bonus',10,2)->default(0);//prima
            $table->decimal('layoffs',10,2)->default(0);//cesantias
            $table->decimal('disabilities',10,2)->default(0);//incapacidades
            $table->decimal('licenses',10,2)->default(0);//licencias
            $table->decimal('bonuses',10,2)->default(0);//bonificaciones
            $table->decimal('aids',10,2)->default(0);//ayudas
            $table->decimal('commissions',10,2)->default(0);//comisiones
            $table->decimal('payment_thirds',10,2)->default(0);//pagos a terceros
            $table->decimal('advances',10,2)->default(0);//anticipos
            $table->decimal('compensations',10,2)->default(0);//compensaciones
            $table->decimal('bonuses_EPCTV',10,2)->default(0);//bonOS EPCTV
            $table->decimal('other_concepts',10,2)->default(0);//otros conceptos
            $table->decimal('legal_strikes',10,2)->default(0);//huelgas legales
            $table->decimal('optionales',10,2)->default(0);//huelgas

            $table->foreignId('payroll_partial_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_partial_acrueds');
    }
};
