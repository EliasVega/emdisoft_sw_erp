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
        Schema::create('overtime_types', function (Blueprint $table) {
            $table->id();

            $table->string('code',6);
            $table->string('hour_type', 45);
            $table->string('apply_time', 100);
            $table->decimal('percentage',10,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_types');
    }
};
