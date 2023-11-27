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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('identification', 20)->unique();
            $table->string('address', 100);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('code', 20);
            $table->decimal('salary', 10,2);
            $table->date('admission_date');
            $table->string('account_type', 20);
            $table->string('account_number', 20);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreignId('branch_id')->constrained()->onUpdate('cascade');
            $table->foreignId('department_id')->constrained()->onUpdate('cascade');
            $table->foreignId('municipality_id')->constrained()->onUpdate('cascade');
            $table->foreignId('identification_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('employee_type_id')->constrained();
            $table->foreignId('employee_subtype_id')->constrained();
            $table->foreignId('payment_frecuency_id')->constrained();
            $table->foreignId('contrat_type_id')->constrained();
            $table->foreignId('charge_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('bank_id')->constrained();

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
        Schema::dropIfExists('employees');
    }
};
