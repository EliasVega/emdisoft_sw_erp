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
        Schema::create('provisions', function (Blueprint $table) {
            $table->id();

            $table->decimal('vacations', 10,2);//Vacaciones
            $table->decimal('bonus', 10,2);//Primas
            $table->decimal('layoffs', 10,2);//Cesantias
            $table->decimal('layoff_interest', 10,2);//Intereses de Cesantias

            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provisions');
    }
};
