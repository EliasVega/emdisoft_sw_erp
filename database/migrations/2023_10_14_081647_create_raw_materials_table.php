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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();

            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->decimal('price', 10,2); //precio de compra
            $table->decimal('stock', 11,2);
            $table->enum('type_product', ['product', 'service']);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('measure_unit_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
