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
        Schema::create('product_rawmaterials', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity', 10, 2);//cantidad de producto que consume el producto
            $table->decimal('consumer_price', 11, 2);//precio del producto
            $table->decimal('subtotal', 11, 2);//cantidad por el precio

            $table->foreignId('product_id')->constrained()->onUpdate('restrict');
            $table->foreignId('raw_material_id')->constrained()->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_rawmaterials');
    }
};
