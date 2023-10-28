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
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();

            $table->decimal('cash_initial',20,2);//inicio efectivo
            $table->decimal('in_cash',20,2);//ingresos de efectivo sin comprobante
            $table->decimal('out_cash',20,2);//total salidas de efectivo entregas de caja
            $table->decimal('in_total',20,2);//total ingresos pagos en general
            $table->decimal('out_total',20,2);//total de egresos pagos en general
            $table->decimal('cash_in_total',20,2);//total entradas efectivo
            $table->decimal('cash_out_total',20,2);//total salidas efectivo

            $table->decimal('invoice_order',20,2);//total de pedidos
            $table->decimal('restaurant_order', 20,2); //total comandas

            $table->decimal('in_invoice_cash',20,2);//ingreso efectivo por ventas
            $table->decimal('in_invoice',20,2);//ingreso total por ventas
            $table->decimal('invoice',20,2);//total de ventas

            $table->decimal('in_advance_cash', 20,2);//ingreso de efectivo por avances
            $table->decimal('in_advance', 20,2);//ingreso total por avances

            //$table->decimal('in_ndinvoice_cash',20,2);//ingreso de efectivo nota debito ventas
            //$table->decimal('in_ndinvoice',20,2);//ingreso total por nota debito ventas
            $table->decimal('ndinvoice',20,2);//total notas debito ventas

            //$table->decimal('in_ncpurchase_cash',20,2); //ingreso efectivo notas credito compras
            //$table->decimal('in_ncpurchase',20,2); //ingreso total notas debito compras
            $table->decimal('ncpurchase',20,2);//total de notas credito compras

            $table->decimal('purchase_order',20,2);//total de pedidos

            $table->decimal('out_purchase_cash',20,2);//salida efectivo compras
            $table->decimal('out_purchase',20,2);//salida total compras
            $table->decimal('purchase',20,2);//total de compras

            $table->decimal('out_expense_cash',20,2);//salida efectivo compras gastos
            $table->decimal('out_expense',20,2);//salida total compras gastos
            $table->decimal('expense',20,2);//total de gastos

            $table->decimal('out_advance_cash',20,2);//total pagos anticipos
            $table->decimal('out_advance',20,2);//total pagos anticipos

            //$table->decimal('out_ndpurchase_cash',20,2);//salida de efectivo nota debito compras
            //$table->decimal('out_ndpurchase',20,2);//salida total por nota debito compras
            $table->decimal('ndpurchase',20,2);//total de notas debito compras

            //$table->decimal('out_ncinvoice_cash',20,2); //salida efectivo notas credito ventas
            //$table->decimal('out_ncinvoice',20,2); //salida total por notas credito ventas
            $table->decimal('ncinvoice',20,2);//total de notas credito ventas


            $table->string('verification_code_open',12);//codigo verif apertura de caja
            $table->string('verification_code_close',12)->nullable();//cod verif cierre de caja
            $table->enum('status', ['open', 'close'])->default('open');

            $table->foreignId('branch_id')->constrained();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('user_open_id')
            ->references('id')
            ->on('users');
            $table->foreignId('user_close_id')
            ->nullable()
            ->references('id')
            ->on('users');

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
        Schema::dropIfExists('cash_registers');
    }
};
