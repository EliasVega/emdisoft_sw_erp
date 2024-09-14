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
        Schema::create('pucs', function (Blueprint $table) {
            $table->id();
            //description    ---- usa, aplica

            $table->morphs('accountable');//referencia al PUC la cuanta a la que pertenece
            $table->string('description',100)->nullable();
            $table->string('implication',30)->nullable();//ej: numero cuenta del banco
            $table->foreignId('bank_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');//referencia al banco
            //motivo por el cual se activa el movimiento del puc
            $table->foreignId('trigger_method_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            //especifica el tipo de movimiento
            $table->foreignId('movement_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            //el tipo de operación que se realiza
            $table->foreignId('operation_type_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pucs');
    }
};
