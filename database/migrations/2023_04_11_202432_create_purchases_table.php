<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->string('document', 20);//prefijo y numero de factura
            $table->string('invoice_code', 20);//numero factura de compra
            $table->date('generation_date');//fecha de generacion
            $table->date('due_date');//fecha limite de pago
            $table->decimal('total',12, 2);//subtotal de la factura
            $table->decimal('total_tax', 12, 2);//total iva
            $table->decimal('total_pay',12, 2);//total de la factura
            $table->decimal('pay',12, 2);//total pago o abono
            $table->decimal('balance', 12, 2);//saldo de la factura
            $table->decimal('retention', 12,2);//valor total de retenciones
            $table->decimal('grand_total', 12,2); //Total de factura mas notas credito y menos notas debito +- retenciones
            $table->date('start_date')->nullable();//inicio de ds para tipo de generacion
            $table->enum('status',['purchase', 'support_document', 'debit_note', 'credit_note', 'adjustment_note', 'complete'])->default('purchase');
            $table->string('note', 255)->nullable();//nota abierta

            $table->foreignId('user_id')->constrained();
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_form_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('generation_type_id')->nullable()->constrained();
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('document_type_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
