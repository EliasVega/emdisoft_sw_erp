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

            $table->decimal('total',15,3);//subtotal de la orden
            $table->decimal('total_tax',15,3);//total impuestos iva inc
            $table->decimal('total_pay',15,3);//total de la orden
            $table->enum('status',['pending', 'generated', 'canceled'])->default('pending');
            $table->string('note',255)->nullable();//nota abierta

            $table->foreignId('branch_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cash_register_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('restaurant_table_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('customer_home_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
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
