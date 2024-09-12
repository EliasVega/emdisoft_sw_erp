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
        Schema::create('payroll_acrueds', function (Blueprint $table) {
            $table->id();

            $table->decimal('salary', 20,4);//salario asignado
            $table->decimal('transport_assistance',20,4);//auxilio de trasporte
            $table->decimal('overtime',20,4)->default(0);//horas extras
            $table->decimal('vacations',20,4)->default(0);//vacaciones
            $table->decimal('bonus',20,4)->default(0);//prima
            $table->decimal('layoffs',20,4)->default(0);//cesantias
            $table->decimal('disabilities',20,4)->default(0);//incapacidades
            $table->decimal('licenses',20,4)->default(0);//licencias
            $table->decimal('bonuses',20,4)->default(0);//bonificaciones
            $table->decimal('aids',20,4)->default(0);//ayudas
            $table->decimal('commissions',20,4)->default(0);//comisiones
            $table->decimal('payment_thirds',20,4)->default(0);//pagos a terceros
            $table->decimal('advances',20,4)->default(0);//anticipos
            $table->decimal('compensations',20,4)->default(0);//compensaciones
            $table->decimal('bonuses_EPCTV',20,4)->default(0);//bonOS EPCTV
            $table->decimal('other_concepts',20,4)->default(0);//otros conceptos
            $table->decimal('legal_strikes',20,4)->default(0);//huelgas legales
            $table->decimal('optionales',20,4)->default(0);//huelgas

            $table->foreignId('payroll_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_acrueds');
    }
};
