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
        Schema::create('employee_invoice_order_products', function (Blueprint $table) {
            $table->id();

            $table->date('generation_date');//fecha de generacion
            $table->decimal('quantity',15,3);
            $table->decimal('price',15,3);
            $table->decimal('subtotal',15,3);
            $table->decimal('commission',15,3);
            $table->decimal('value_commission',15,3);
            $table->enum('status',['pendient', 'invoiced', 'canceled'])->default('pendient');

            $table->foreignId('work_labor_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('invoice_order_product_id')->constrained()->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_invoice_order_products');
    }
};
