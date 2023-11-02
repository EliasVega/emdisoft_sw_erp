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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('quantiry',10,2);
            $table->decimal('hour_value',10,2);
            $table->decimal('total',10,2);

            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');
            $table->foreignId('overtime_type_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
