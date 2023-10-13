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
        Schema::create('ncinvoice_responses', function (Blueprint $table) {
            $table->id();

            $table->string('document', 20);
            $table->string('cude', 100);
            $table->string('message', 100);
            $table->string('valid', 5);
            $table->string('code', 3);
            $table->string('description', 100);
            $table->string('status_message', 100);
            $table->foreignId('ncinvoice_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ncinvoice_responses');
    }
};
