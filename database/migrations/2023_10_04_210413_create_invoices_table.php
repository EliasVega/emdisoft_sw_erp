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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('document', 20);//prefijo y consecutivo
            $table->date('generation_date');//fecha de generacion
            $table->date('due_date');//fecha limite de pago
            $table->decimal('total', 20, 2);//subtotal de la factura
            $table->decimal('total_tax', 11, 2);//total impuestos de linea
            $table->decimal('total_pay', 20, 2);//total mas impuestos
            $table->decimal('pay',20,2);//total pagos y abonos
            $table->decimal('balance',20,2);//saldo de la factura
            $table->decimal('retention',10,2);//valor total de las retenciones
            $table->decimal('grand_total',12,2);//Total de factura mas notas credito y menos notas debito +- retenciones
            $table->enum('status',['invoice', 'credit_note', 'debit_note', 'complete'])->default('invoice');
            $table->string('note', 255)->nullable();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_form_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('document_type_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
