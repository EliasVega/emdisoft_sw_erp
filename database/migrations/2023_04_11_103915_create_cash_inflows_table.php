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
        Schema::create('cash_inflows', function (Blueprint $table) {
            $table->id();

            $table->decimal('cash',10,2);
            $table->string('reason', 50);

            $table->foreignId('cash_register_id')->constrained();//recibe
            $table->foreignId('user_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('admin_id')
            ->references('id')
            ->on('users');//entrega

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
        Schema::dropIfExists('cash_inflows');
    }
};
