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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();

            $table->decimal('total',15,3);//subtotal de la factura
            $table->decimal('total_tax',15,3);//total impuestos iva inc
            $table->decimal('total_pay',15,3);//total de la factura
            $table->decimal('balance',15,3);//saldo de la factura
            $table->enum('status',['active', 'generated', 'canceled'])->default('active');
            $table->enum('type_product',['product', 'raw_material'])->default('product');
            $table->string('note',255)->nullable();//nota abierta

            $table->foreignId('user_id')->constrained();
            $table->foreignId('provider_id')->constrained()->onUpdate('cascade');
            $table->foreignId('cash_register_id')->nullable()->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
