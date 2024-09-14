<?php

use Dompdf\FrameDecorator\Table;
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
        Schema::create('overtime_months', function (Blueprint $table) {
            $table->id();

            $table->string('year_month',10);//año y mes de liquidacion
            $table->decimal('quantity',15,3);//cantidad de horas del mes de este tipo
            $table->decimal('value_hour',15,3);//valor que corresponde a este tipo de hora
            $table->decimal('subtotal',15,3);//cantidad por valor de hora
            $table->enum('status',['pendient', 'canceled'])->default('pendient');//esado de pendiente o cancelada

            $table->foreignId('overtime_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('overtime_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_months');
    }
};
