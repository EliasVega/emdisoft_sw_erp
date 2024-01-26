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
        Schema::create('work_labors', function (Blueprint $table) {
            $table->id();

            $table->date('generation_date');//fecha de generacion
            $table->decimal('total_pay', 20, 2);//subtotal de la factura
            $table->string('note', 255)->nullable();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade');
            $table->foreignId('pay_id')->nullable()->default(null)->constrained()->onUpdate('cascade');
            $table->foreignId('voucher_type_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_labors');
    }
};
