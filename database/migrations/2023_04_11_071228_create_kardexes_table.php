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
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();

            $table->morphs('kardexable');
            $table->string('document', 20);
            $table->decimal('quantity',10,2);
            $table->decimal('stock',10,2);
            $table->enum('movement', ['purchase', 'expense', 'invoice', 'ncpurchase', 'ndpurchase', 'ncinvoice', 'ndinvoice'])->default('purchase');

            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('kardexes');
    }
};
