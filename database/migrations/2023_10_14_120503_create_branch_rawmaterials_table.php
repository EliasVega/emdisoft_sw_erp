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
        Schema::create('branch_rawmaterials', function (Blueprint $table) {
            $table->id();

            $table->decimal('stock', 10,2);//stock por branch

            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('raw_material_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_rawmaterials');
    }
};
