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
        Schema::create('percentages', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->decimal('percentage', 10,2);
            $table->bigInteger('base')->default(0);
            $table->integer('base_uvt')->default(0);
            $table->string('concept', 255);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->foreignId('tax_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('percentages');
    }
};
