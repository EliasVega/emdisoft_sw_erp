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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();

            $table->string('year_month',10);//año y mes de liquidacion
            $table->decimal('total',20,3);//valor de este tipo de hora

            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payroll_acrued_id')->nullable()->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
