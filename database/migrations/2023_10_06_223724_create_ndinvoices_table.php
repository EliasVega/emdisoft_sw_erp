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
        Schema::create('ndinvoices', function (Blueprint $table) {
            $table->id();

            $table->string('document', 20);//prefijo y numero de nota debito
            $table->decimal('retention', 12,2);//valor total de retenciones
            $table->decimal('total', 20, 2);//total antes de impuestos de linea
            $table->decimal('total_tax', 11, 2);//total impuestos de linea
            $table->decimal('total_pay', 20, 2);//tottal mas impuestos de lines
            $table->text('note')->nullable();// nota de informacion

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('invoice_id')->constrained()->onUpdate('cascade');
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->constrained()->onUpdate('cascade');
            $table->foreignId('discrepancy_id')->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ndinvoices');
    }
};
