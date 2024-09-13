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
        Schema::create('invoice_orders', function (Blueprint $table) {
            $table->id();

            $table->date('generation_date');//fecha de generacion
            $table->date('due_date');//fecha limite de pago
            $table->decimal('total', 20, 3);//subtotal de la factura
            $table->decimal('total_tax', 20, 3);//total impuestos iva inc
            $table->decimal('total_pay', 20, 3);//total de la factura
            $table->enum('status',['active', 'generated', 'canceled'])->default('active');
            $table->enum('type',['order', 'pre-invoice', 'quote'])->default('order');
            $table->string('note', 255)->nullable();//nota abierta

            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('invoice_id')->nullable()->constrained();
            $table->foreignId('cash_register_id')->nullable()->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_orders');
    }
};
