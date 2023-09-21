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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();

            $table->morphs('taxable');
            $table->decimal('tax_value', 10,2);
            $table->enum('type', ['purchase', 'invoice', 'ndpurchase', 'ncpurchase', 'ncinvoice', 'ndinvoice'])->default('purchase');

            $table->foreignId('company_tax_id')->constrained();
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
        Schema::dropIfExists('taxes');
    }
};
