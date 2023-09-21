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

            $table->string('document', 20);//prefijo y numero de nota debito
            $table->decimal('retention', 12,2);//valor total de retenciones
            $table->decimal('total', 20, 2);//total antes de impuestos de linea
            $table->decimal('total_tax', 11, 2);//total impuestos de linea
            $table->decimal('total_pay', 20, 2);//tottal mas impuestos de lines
            $table->text('note')->nullable();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('purchase_id')->constrained()->onUpdate('cascade');
            $table->foreignId('provider_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->constrained()->onUpdate('cascade');
            $table->foreignId('discrepancy_id')->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');

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
