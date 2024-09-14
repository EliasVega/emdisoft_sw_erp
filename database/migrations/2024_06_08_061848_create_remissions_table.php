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
        Schema::create('remissions', function (Blueprint $table) {
            $table->id();

            $table->string('document',20);//prefijo y consecutivo
            $table->date('generation_date');//fecha de generacion
            $table->date('due_date');//fecha limite de pago
            $table->decimal('total',15,3);//subtotal de la factura
            $table->decimal('total_tax',15,3);//total impuestos de linea
            $table->decimal('total_pay',15,3);//total mas impuestos
            $table->decimal('pay',15,3);//total pagos y abonos
            $table->decimal('balance',15,3);//saldo de la factura
            $table->decimal('retention',15,3);//valor total de las retenciones
            $table->decimal('grand_total',15,3);//Total de factura mas notas credito y menos notas debito +- retenciones
            $table->enum('status',['active', 'generated', 'canceled'])->default('active');
            $table->string('note',255)->nullable();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_form_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('document_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('cash_register_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remissions');
    }
};
