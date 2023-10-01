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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('identification', 20)->unique();
            $table->string('dv', 1);
            $table->string('address', 100);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('merchant_registration', 12)->default('000000,00');
            $table->string('contact', 50)->nullable();
            $table->string('phone_contact', 20)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreignId('department_id')->constrained()->onUpdate('cascade');
            $table->foreignId('municipality_id')->constrained()->onUpdate('cascade');
            $table->foreignId('postal_code_id')->constrained()->onUpdate('cascade');
            $table->foreignId('identification_type_id')->constrained()->onUpdate('cascade');
            $table->foreignId('liability_id')->constrained()->onUpdate('cascade');
            $table->foreignId('organization_id')->constrained()->onUpdate('cascade');
            $table->foreignId('regime_id')->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('providers');
    }
};
