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
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();

            $table->date('start_period');//fecha inicio Periodo prima
            $table->date('end_period');//fecha fin Periodo prima
            $table->integer('bonus_days');//Numero de dias de prima
            $table->decimal('bonus_value');//Valor devengado de prima
            $table->enum('type',['salary', 'non-salary'])->default('salary');//typo de prima salarial o no salarial

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
        Schema::dropIfExists('bonuses');
    }
};
