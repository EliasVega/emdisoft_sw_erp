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
        Schema::create('payroll_partial_deductions', function (Blueprint $table) {
            $table->id();

            $table->decimal('eps',20,3)->default(0);//empres promotora de salud
            $table->decimal('pension',20,3)->default(0);//aportes a pension
            $table->decimal('fsp',20,3)->default(0);//fondo de solidaridad pensional
            $table->decimal('subsistence_fund',20,3)->default(0);//fondo de subsistencia
            $table->decimal('unions',20,3)->default(0);//sindicatos
            $table->decimal('sanctions',20,3)->default(0);//sanciones
            $table->decimal('advances',20,3)->default(0);//anticipos
            $table->decimal('payment_thirds',20,3)->default(0);//pagos a terceros
            $table->decimal('other_deductions',20,3)->default(0);//otras deducciones
            $table->decimal('releases',20,3)->default(0);//libranzas
            $table->decimal('optionales',20,3)->default(0);//huelgas legales

            $table->foreignId('payroll_partial_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_partial_deductions');
    }
};
