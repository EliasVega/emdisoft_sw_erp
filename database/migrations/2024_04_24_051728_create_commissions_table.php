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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();

            $table->date('start_commission');//fecha inicio periodo comisiones
            $table->date('end_commission');//fecha fin periodo comisiones
            $table->string('type_commission', 12);//tipo de novedad salarial no salarial
            $table->decimal('value_commission',20,3);//valor de la novedad
            $table->string('note', 100)->nullable();//observacion de la novedad

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
        Schema::dropIfExists('commissions');
    }
};
