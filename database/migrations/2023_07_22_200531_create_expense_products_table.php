<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_products', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity', 20,3);
            $table->decimal('price', 20,3);
            $table->decimal('tax_rate', 20,3);
            $table->decimal('subtotal', 20,3);
            $table->decimal('tax_subtotal', 20,3);

            $table->foreignId('expense_id')->constrained()->onUpdate('restrict');
            $table->foreignId('product_id')->constrained()->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_products');
    }
};
