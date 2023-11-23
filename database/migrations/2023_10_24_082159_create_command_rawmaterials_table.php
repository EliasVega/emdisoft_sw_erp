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
        Schema::create('command_rawmaterials', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity',10,2);
            $table->integer('referency');
            $table->enum('status', ['add', 'decrease', 'cancel', 'anulled'])->default('add');

            $table->foreignId('restaurant_order_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('raw_material_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('command_rawmaterials');
    }
};
