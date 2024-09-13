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
        Schema::create('purchase_order_rawmaterials', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity', 20, 3);
            $table->decimal('price', 20, 3);
            $table->decimal('tax_rate', 20, 3);
            $table->decimal('subtotal', 20, 3);
            $table->decimal('tax_subtotal', 20, 3);

            $table->foreignId('purchase_order_id')->constrained();
            $table->foreignId('raw_material_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_rawmaterials');
    }
};
