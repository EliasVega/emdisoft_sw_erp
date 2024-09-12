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
        Schema::create('ndinvoice_products', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');
            $table->integer('price');
            $table->decimal('tax_rate', 20,4);
            $table->decimal('subtotal', 20,4);
            $table->decimal('tax_subtotal', 20,4);

            $table->foreignId('ndinvoice_id')->constrained()->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ndinvoice_products');
    }
};
