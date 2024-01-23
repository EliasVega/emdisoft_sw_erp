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

            $table->decimal('quantity', 10, 2);
            $table->decimal('price', 11, 2);
            $table->decimal('subtotal', 11, 2);
            $table->decimal('commission', 10, 2);
            $table->decimal('value_commission', 11, 2);
            $table->enum('status',['pendient', 'canceled'])->default('pendient');

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
