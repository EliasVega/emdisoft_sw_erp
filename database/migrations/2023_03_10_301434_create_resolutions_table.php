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
        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();

            $table->string('prefix', 4);
            $table->string('resolution', 20)->nullable();
            $table->date('resolution_date')->nullable();
            $table->string('technical_key', 64)->nullable();
            $table->bigInteger('start_number');
            $table->bigInteger('end_number');
            $table->bigInteger('consecutive')->default(1);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('document_type_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('resolutions');
    }
};
