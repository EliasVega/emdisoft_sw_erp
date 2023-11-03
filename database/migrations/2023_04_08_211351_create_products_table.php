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
            $table->string('name', 100);
            $table->decimal('price', 10,2); //precio de compra
            $table->decimal('sale_price', 11,2);
            $table->decimal('stock', 11,2);
            $table->enum('type_product', ['product', 'service', 'consumer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('imageName', 45);
            $table->string('image', 255);

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
