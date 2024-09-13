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
        Schema::create('causations', function (Blueprint $table) {
            $table->id();

            $table->string('causation', 12);//nombre de la causacion aplicada
            $table->date('start_causation_period')->nullable();//fecha inicio periodo de vacaciones
            $table->date('end_causation_period')->nullable();//fecha fin periodo de vacaciones
            $table->decimal('causation_value', 20,3);//valor de vacaciones
            $table->decimal('causation_interest', 20,3);//valor de vacaciones
            $table->enum('status',['pendient', 'canceled'])->default('pendient');//typo de vacaciones disfrutadas o compensadas

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
        Schema::dropIfExists('causations');
    }
};
