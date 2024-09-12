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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount', 20,4);
            $table->enum('type', ['credit', 'debit']);
            $table->string('description');
            $table->morphs('movementable');
            $table->foreignId('accounting_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cost_center_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('puc_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
