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
        Schema::create('product_restaurant_orders', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity', 10, 2);
            $table->decimal('price', 11, 2);
            $table->decimal('tax_rate', 10, 2);
            $table->decimal('subtotal', 11, 2);
            $table->decimal('tax_subtotal', 11, 2);
            $table->boolean('edition')->default(true);
            $table->enum('status', ['new', 'registered', 'canceled'])->default('new');

            $table->foreignId('restaurant_order_id')->constrained()->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_restaurant_orders');
    }
};
