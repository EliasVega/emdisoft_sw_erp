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
        Schema::create('pay_restaurant_orders', function (Blueprint $table) {
            $table->id();

            $table->decimal('pay',20,4);
            $table->string('transaction',20,4)->nullable();

            $table->foreignId('restaurant_order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_form_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('bank_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('card_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_restaurant_orders');
    }
};
