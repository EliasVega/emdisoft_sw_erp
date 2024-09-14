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
        Schema::create('payroll_deductions', function (Blueprint $table) {
            $table->id();

            $table->decimal('eps',15,3)->default(0);//empres promotora de salud
            $table->decimal('pension',15,3)->default(0);//aportes a pension
            $table->decimal('fsp',15,3)->default(0);//fondo de solidaridad pensional
            $table->decimal('subsistence_fund',15,3)->default(0);//fondo de subsistencia
            $table->decimal('unions',15,3)->default(0);//sindicatos
            $table->decimal('sanctions',15,3)->default(0);//sanciones
            $table->decimal('advances',15,3)->default(0);//anticipos
            $table->decimal('payment_thirds',15,3)->default(0);//pagos a terceros
            $table->decimal('other_deductions',15,3)->default(0);//otras deducciones
            $table->decimal('releases',15,3)->default(0);//libranzas
            $table->decimal('optionales',15,3)->default(0);//huelgas legales

            $table->foreignId('payroll_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_deductions');
    }
};
