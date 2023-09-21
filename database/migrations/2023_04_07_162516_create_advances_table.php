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
        Schema::create('advances', function (Blueprint $table) {
            $table->id();

            $table->string('document', 20);
            $table->string('origin', 50);
            $table->string('destination', 20)->nullable();
            $table->decimal('pay',10,2);
            $table->decimal('balance',10,2);
            $table->string('note', 255)->nullable();
            $table->morphs('advanceable');
            $table->enum('status',['pending', 'partial', 'applied'])->default('pending');
            $table->enum('type_third', ['customer', 'provider', 'employee'])->default('customer');

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('advances');
    }
};
