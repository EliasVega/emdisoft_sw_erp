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
        Schema::create('invoice_test_sets', function (Blueprint $table) {
            $table->id();

            $table->string('document_type',4);
            $table->string('message',256);
            $table->string('zipKey',50)->nullable();
            $table->string('cufe',100);

            $table->foreignId('company_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_test_sets');
    }
};
