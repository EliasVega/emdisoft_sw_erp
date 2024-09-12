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
        Schema::create('auxiliary_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('code', 8)->unique();
            $table->string('name', 100);
            $table->decimal('total_amount', 20,4);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->foreignId('subaccount_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auxiliary_accounts');
    }
};
