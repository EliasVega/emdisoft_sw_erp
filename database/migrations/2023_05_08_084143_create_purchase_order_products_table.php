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
        Schema::create('purchase_order_products', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity',15,3);
            $table->decimal('price',15,3);
            $table->decimal('tax_rate',15,3);
            $table->decimal('subtotal',15,3);
            $table->decimal('tax_subtotal',15,3);

            $table->foreignId('purchase_order_id')->constrained()->onUpdate('restrict');
            $table->foreignId('product_id')->constrained()->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_products');
    }
};
