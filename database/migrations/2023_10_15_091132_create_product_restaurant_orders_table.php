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

            $table->integer('referency');//referencia asignada para manejo de MP
            $table->decimal('quantity',15,3);//cantidad de productos
            $table->decimal('price',15,3);//precio del producto
            $table->decimal('tax_rate',15,3);//impuesto
            $table->decimal('subtotal',15,3);//cantidad por precio
            $table->decimal('tax_subtotal',15,3);//impuesto de esta linea
            $table->boolean('edition')->default(true);//define si es editada o no
            $table->enum('status', ['new', 'registered', 'canceled'])->default('new');//define estado para produccion

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
