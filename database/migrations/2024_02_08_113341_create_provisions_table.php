<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provisions', function (Blueprint $table) {
            $table->id();

            $table->date('start_period_vacations');//fecha inicio periodo de vacaciones
            $table->integer('vacation_days');//dias de vacaciones
            $table->decimal('vacations',15,3);//Vacaciones
            $table->date('start_period_bonus');//fecha inicio periodo de Prima
            $table->integer('bonus_days');//dias de prima
            $table->decimal('bonus',15,3);//Primas
            $table->date('start_period_layoffs');//fecha inicio periodo de Cesantias
            $table->integer('layoff_days');//dias de cesantias
            $table->decimal('layoffs',15,3);//Cesantias
            $table->decimal('layoff_interest',15,3);//Intereses de Cesantias

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
