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
        Schema::create('home_orders', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['home', 'rappi'])->default('home');
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('phone', 255);
            $table->string('domiciliary', 50)->nullable();
            $table->integer('domicile_value')->nullable();
            $table->time('time_receipt');
            $table->time('time_sent')->nullable();

            $table->foreignId('restaurant_order_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_orders');
    }
};
