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
        Schema::create('sale_points', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('plate_number', 20)->unique();
            $table->string('location',100);
            $table->string('cash_type',100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_points');
    }
};
