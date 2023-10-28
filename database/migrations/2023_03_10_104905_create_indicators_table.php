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
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();

            $table->decimal('smlv', 12,2);
            $table->decimal('transport_assistance', 10,2);
            $table->decimal('uvt',10,2);
            $table->decimal('plastic_bag_tax', 10,2);
            $table->enum('dian', ['on', 'off'])->default('off');
            $table->enum('pos', ['on', 'off'])->default('on');
            $table->enum('logo', ['on', 'off'])->default('on');
            $table->enum('payroll', ['on', 'off'])->default('off');
            $table->enum('accounting', ['on', 'off'])->default('off');
            $table->enum('inventory', ['on', 'off'])->default('on');
            $table->enum('product_price', ['automatic', 'manual'])->default('automatic');
            $table->enum('raw_material', ['on', 'off'])->default('off');
            $table->enum('restaurant',['on', 'off'])->default('off');

            $table->foreignId('company_id')->constrained();

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
        Schema::dropIfExists('indicators');
    }
};
