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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();

            $table->date('start_date');//fecha inicio vacaciones
            $table->date('end_date');//fecha fin de vacaciones
            $table->decimal('value', 10, 2);
            $table->enum('type',['taken', 'compensated'])->default('taken');

            $table->foreignId('payroll_acrued_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
