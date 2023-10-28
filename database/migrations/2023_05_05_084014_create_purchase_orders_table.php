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

            $table->decimal('total', 20, 2);//subtotal de la factura
            $table->decimal('total_tax', 11, 2);//total impuestos iva inc
            $table->decimal('total_pay', 20, 2);//total de la factura
            $table->decimal('pay',12, 2);//total pago o abono
            $table->decimal('balance', 20, 2);//saldo de la factura
            $table->enum('status',['active', 'generated', 'canceled'])->default('active');
            $table->string('note', 255)->nullable();//nota abierta

            $table->foreignId('user_id')->constrained();
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained()->onUpdate('cascade');

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
