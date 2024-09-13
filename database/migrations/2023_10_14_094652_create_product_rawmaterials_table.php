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

            $table->decimal('quantity', 20,3);//cantidad de producto que consume el producto
            $table->decimal('consumer_price', 20,3);//precio del producto
            $table->decimal('subtotal', 20,3);//cantidad por el precio

            $table->foreignId('product_id')->constrained()->onUpdate('cascade');
            $table->foreignId('raw_material_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

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
