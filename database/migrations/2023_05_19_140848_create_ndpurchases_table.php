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
        Schema::create('ndpurchases', function (Blueprint $table) {
            $table->id();

            $table->string('document',20);//prefijo y numero de nota debito
            $table->decimal('retention',15,3);//valor total de retenciones
            $table->decimal('total',15,3);//total antes de impuestos de linea
            $table->decimal('total_tax',15,3);//total impuestos de linea
            $table->decimal('total_pay',15,3);//tottal mas impuestos de lines
            $table->text('note')->nullable();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('purchase_id')->constrained()->onUpdate('cascade');
            $table->foreignId('provider_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->constrained()->onUpdate('cascade');
            $table->foreignId('discrepancy_id')->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cash_register_id')->nullable()->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('ndpurchases');
    }
};
