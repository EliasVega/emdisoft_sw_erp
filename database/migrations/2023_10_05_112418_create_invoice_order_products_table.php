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
        Schema::create('invoice_order_products', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity',15,3);
            $table->decimal('price',15,3);
            $table->decimal('tax_rate',15,3);
            $table->decimal('subtotal',15,3);
            $table->decimal('tax_subtotal',15,3);

            $table->foreignId('invoice_order_id')->constrained()->onUpdate('restrict');
            $table->foreignId('product_id')->constrained()->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_order_products');
    }
};
