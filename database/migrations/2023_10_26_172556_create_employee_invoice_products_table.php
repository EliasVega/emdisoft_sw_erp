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
        Schema::create('employee_invoice_products', function (Blueprint $table) {
            $table->id();

            $table->date('generation_date');//fecha de generacion
            $table->decimal('quantity', 20,3);
            $table->decimal('price', 20,3);
            $table->decimal('subtotal', 20,3);
            $table->decimal('commission', 20,3);
            $table->decimal('value_commission', 20,3);
            $table->enum('status',['pendient', 'canceled', 'credit_note'])->default('pendient');

            $table->foreignId('work_labor_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('invoice_product_id')->constrained()->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_invoice_products');
    }
};
