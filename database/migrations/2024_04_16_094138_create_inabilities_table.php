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
        Schema::create('inabilities', function (Blueprint $table) {
            $table->id();

            $table->date('start_inability');//fecha inicio Incapacidad
            $table->date('end_inability');//fecha fin Incapacidad
            $table->integer('days_inability');//dias de incapacidad para este periodo
            $table->decimal('value_day',10,2);//valor del dia segun la incapacidad
            $table->decimal('total_inability',10,2);//valor total de la incapacidad
            $table->enum('origin', ['common', 'labor'])->default('common');//incapacidad de origen comun o laboral

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
        Schema::dropIfExists('inabilities');
    }
};
