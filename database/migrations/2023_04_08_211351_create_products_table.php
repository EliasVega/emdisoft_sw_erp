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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('code', 20)->unique();
            $table->string('name', 200);
            $table->decimal('price', 20,3); //precio de compra
            $table->decimal('sale_price', 20,3);
            $table->decimal('commission', 20,3)->default(0);
            $table->decimal('stock', 16,2)->default(0);
            $table->decimal('stock_min',16,2)->default(1);
            $table->enum('type_product', ['product', 'service', 'consumer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('imageName', 45)->nullable();
            $table->string('image', 255)->nullable();

            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('measure_unit_id')->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('products');
    }
};
