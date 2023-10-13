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
        Schema::create('ncpurchases', function (Blueprint $table) {
            $table->id();

            $table->string('document', 20);//prefijo y numero de nota credito
            $table->decimal('retention', 12,2);//valor total de retenciones
            $table->decimal('total', 20, 2);//total antes de impuestos de linea
            $table->decimal('total_tax', 10, 2);//total de impuestos de linea
            $table->decimal('total_pay', 20, 2);//total mas impuestos de linea
            $table->text('note')->nullable();//nota de informacion

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('purchase_id')->constrained()->onUpdate('cascade');
            $table->foreignId('provider_id')->constrained()->onUpdate('cascade');
            $table->foreignId('resolution_id')->nullable()->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('ncpurchases');
    }
};
