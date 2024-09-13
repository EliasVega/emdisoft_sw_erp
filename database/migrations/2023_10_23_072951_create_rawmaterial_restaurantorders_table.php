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
        Schema::create('rawmaterial_restaurantorders', function (Blueprint $table) {
            $table->id();

            $table->integer('referency');
            $table->decimal('quantity', 20,3);
            $table->decimal('total_quantity',20,3);
            $table->decimal('consumer_price', 20,3);

            $table->foreignId('restaurant_order_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('raw_material_id')->constrained()->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rawmaterial_restaurantorders');
    }
};
