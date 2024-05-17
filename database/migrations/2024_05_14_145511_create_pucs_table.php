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
        Schema::create('pucs', function (Blueprint $table) {
            $table->id();

            $table->enum('trigger', ['category', 'payment_method', 'companyTax', 'expense', 'income', 'discount', 'other', 'advance']);
            $table->enum('movement', ['trigger', 'inventory', 'cost', 'refund', 'entry'])->default('trigger');
            $table->enum('type', ['multiple', 'purchases', 'sales'])->default('multiple');
            $table->string('bank_account', 20)->nullable();
            $table->morphs('accountable');
            $table->foreignId('bank_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pucs');
    }
};
