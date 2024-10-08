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
        Schema::create('ndpurchase_products', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');
            $table->integer('price');
            $table->decimal('tax_rate',15,3);
            $table->decimal('subtotal',15,3);
            $table->decimal('tax_subtotal',15,3);

            $table->foreignId('ndpurchase_id')->constrained()->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('ndpurchase_products');
    }
};
