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
        Schema::create('overtime_days', function (Blueprint $table) {
            $table->id();

            $table->string('year_month',10);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->decimal('percentage',10,2);
            $table->decimal('quantity',10,2);
            $table->decimal('value_hour',10,2);
            $table->decimal('subtotal',10,2);

            $table->foreignId('overtime_id')->constrained()->onUpdate('cascade');
            $table->foreignId('overtime_month_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_days');
    }
};
