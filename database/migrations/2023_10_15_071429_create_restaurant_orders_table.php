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
        Schema::create('restaurant_orders', function (Blueprint $table) {
            $table->id();

            $table->decimal('total', 20, 2);//subtotal de la orden
            $table->decimal('total_tax', 11, 2);//total impuestos iva inc
            $table->decimal('total_pay', 20, 2);//total de la orden
            $table->enum('status',['pending', 'generated', 'canceled'])->default('pending');
            $table->string('note', 255)->nullable();//nota abierta

            $table->foreignId('user_id')->constrained();
            $table->foreignId('restaurant_table_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_orders');
    }
};
