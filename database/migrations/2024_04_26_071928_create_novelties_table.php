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
        Schema::create('novelties', function (Blueprint $table) {
            $table->id();

            $table->string('year_month',7);//mes de novedad
            $table->string('type_novelty', 12);//tipo de novedad salarial no salarial
            $table->string('name_novelty', 20);//nombre de la novedad
            $table->decimal('value_novelty',20,3);//valor de la novedad
            $table->string('note', 100)->nullable();//observacion de la novedad
            $table->string('compensation_type',15)->nullable();//tipo de compensacion

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
        Schema::dropIfExists('novelties');
    }
};
