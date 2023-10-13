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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('identification', 20)->unique();
            $table->string('dv', 1)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100);
            $table->string('merchant_registration', 12)->default('000000,00');
            $table->decimal('credit_limit', 10, 2)->nullable()->default(0);
            $table->decimal('used', 12, 2)->nullable()->default(0);
            $table->decimal('available', 12, 2)->nullable()->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('municipality_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('identification_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('liability_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('organization_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('regime_id')->nullable()->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('customers');
    }
};
