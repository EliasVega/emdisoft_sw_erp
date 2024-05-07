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
        Schema::create('software', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained();
            $table->string('identifier', 64)->nullable();
            $table->string('pin', 5)->nullable();
            $table->string('test_set', 64)->nullable();
            $table->string('identifier_payroll',64)->nullable();
            $table->string('pin_payroll', 5)->nullable();
            $table->string('payroll_test_set', 64)->nullable();
            $table->string('identifier_equidoc',64)->nullable();
            $table->string('pin_equidoc', 5)->nullable();
            $table->string('equidoc_test_set', 64)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software');
    }
};
