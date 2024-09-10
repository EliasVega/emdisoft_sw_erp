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
        Schema::create('ndpurchase_rawmaterials', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');
            $table->integer('price');
            $table->decimal('tax_rate', 10, 3);
            $table->decimal('subtotal', 11, 3);
            $table->decimal('tax_subtotal', 11, 3);

            $table->foreignId('ndpurchase_id')->constrained()->onUpdate('cascade');
            $table->foreignId('raw_material_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ndpurchase_rawmaterials');
    }
};
