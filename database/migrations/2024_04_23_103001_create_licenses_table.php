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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();

            $table->date('start_license');//fecha inicio Licencia
            $table->date('end_license');//fecha fin Licencia
            $table->integer('days_license');//dias de Licencia para este periodo
            $table->decimal('value_day',10,2);//valor del dia segun la Licencia
            $table->decimal('total_license',10,2);//valor total de la Licencia
            $table->enum('type_license', ['maternity', 'paternity', 'union', 'mourning', 'others'])->default('others');//Licencia de origen comun o laboral
            $table->enum('type_pay', ['paid', 'unpaid'])->default('paid');//Licencia de typo remunerada no remunerada
            $table->string('note', 255)->nullable();

            $table->foreignId('payroll_acrued_id')->constrained();
            $table->foreignId('payroll_partial_acrued_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
