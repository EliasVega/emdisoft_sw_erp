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

            $table->string('year_month',10);//año y mes de liquidacion
            $table->dateTime('start_time');//hora de inicio de labor
            $table->dateTime('end_time');//hora teminacion de labor
            $table->decimal('quantity',10,2);//cantidad laborada
            $table->decimal('value_hour',10,2);//valor de hora segun el tipo
            $table->decimal('subtotal',10,2);//cantidad por precio
            $table->enum('status',['pendient', 'canceled'])->default('pendient');//esado de pendiente o cancelada

            $table->foreignId('overtime_type_id')->constrained()->onUpdate('cascade');
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
