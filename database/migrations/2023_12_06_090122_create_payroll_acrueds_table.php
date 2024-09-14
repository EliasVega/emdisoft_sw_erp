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

            $table->decimal('salary', 15,3);//salario asignado
            $table->decimal('transport_assistance',15,3);//auxilio de trasporte
            $table->decimal('overtime',15,3)->default(0);//horas extras
            $table->decimal('vacations',15,3)->default(0);//vacaciones
            $table->decimal('bonus',15,3)->default(0);//prima
            $table->decimal('layoffs',15,3)->default(0);//cesantias
            $table->decimal('disabilities',15,3)->default(0);//incapacidades
            $table->decimal('licenses',15,3)->default(0);//licencias
            $table->decimal('bonuses',15,3)->default(0);//bonificaciones
            $table->decimal('aids',15,3)->default(0);//ayudas
            $table->decimal('commissions',15,3)->default(0);//comisiones
            $table->decimal('payment_thirds',15,3)->default(0);//pagos a terceros
            $table->decimal('advances',15,3)->default(0);//anticipos
            $table->decimal('compensations',15,3)->default(0);//compensaciones
            $table->decimal('bonuses_EPCTV',15,3)->default(0);//bonOS EPCTV
            $table->decimal('other_concepts',15,3)->default(0);//otros conceptos
            $table->decimal('legal_strikes',15,3)->default(0);//huelgas legales
            $table->decimal('optionales',15,3)->default(0);//huelgas

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
