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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name',65);
            $table->string('nit',20)->unique();
            $table->string('dv',1);
            $table->string('address',100);
            $table->string('phone',12);
            $table->string('api_token',100);
            $table->string('email',50)->unique();
            $table->string('emailfe',50)->unique();
            $table->string('merchant_registration', 12);
            $table->string('imageName',20);
            $table->string('logo',255)->nullable();
            $table->string('pos_invoice',20)->default('POS');
            $table->string('pos_purchase',20)->default('POS');
            $table->enum('status', ['active', 'inactive'])->default('active');
            //$table->enum('cash_register', ['active', 'inactive'])->default('active');

            $table->foreignId('department_id')->constrained()->onUpdate('cascade')->ondelete('cascade');
            $table->foreignId('municipality_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('identification_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('liability_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('companies');
    }
};
