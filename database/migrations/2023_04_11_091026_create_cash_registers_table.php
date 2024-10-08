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

            $table->decimal('cash_initial',15,3);//inicio efectivo
            $table->decimal('in_cash',15,3);//ingresos de efectivo sin comprobante
            $table->decimal('out_cash',15,3);//total salidas de efectivo entregas de caja
            $table->decimal('in_total',15,3);//total ingresos pagos en general
            $table->decimal('out_total',15,3);//total de egresos pagos en general
            $table->decimal('cash_in_total',15,3);//total entradas efectivo
            $table->decimal('cash_out_total',15,3);//total salidas efectivo

            $table->decimal('invoice_order',15,3);//total de pedidos
            $table->decimal('restaurant_order', 15,3); //total comandas

            $table->decimal('in_invoice_cash',15,3);//ingreso efectivo por ventas
            $table->decimal('in_invoice',15,3);//ingreso total por ventas
            $table->decimal('invoice',15,3);//total de ventas

            $table->decimal('in_remission_cash',15,3)->default(0);//ingreso efectivo por Remision
            $table->decimal('in_remission',15,3)->default(0);//ingreso total por remisiones
            $table->decimal('remission',15,3)->default(0);//total de remisiones

            $table->decimal('in_advance_cash', 15,3);//ingreso de efectivo por avances
            $table->decimal('in_advance', 15,3);//ingreso total por avances

            //$table->decimal('in_ndinvoice_cash',15,3);//ingreso de efectivo nota debito ventas
            //$table->decimal('in_ndinvoice',15,3);//ingreso total por nota debito ventas
            $table->decimal('ndinvoice',15,3);//total notas debito ventas

            //$table->decimal('in_ncpurchase_cash',15,3); //ingreso efectivo notas credito compras
            //$table->decimal('in_ncpurchase',15,3); //ingreso total notas debito compras
            $table->decimal('ncpurchase',15,3);//total de notas credito compras

            $table->decimal('purchase_order',15,3);//total de pedidos

            $table->decimal('out_purchase_cash',15,3);//salida efectivo compras
            $table->decimal('out_purchase',15,3);//salida total compras
            $table->decimal('purchase',15,3);//total de compras

            $table->decimal('out_expense_cash',15,3);//salida efectivo compras gastos
            $table->decimal('out_expense',15,3);//salida total compras gastos
            $table->decimal('expense',15,3);//total de gastos

            $table->decimal('out_advance_cash',15,3);//total pagos anticipos
            $table->decimal('out_advance',15,3);//total pagos anticipos

            //$table->decimal('out_ndpurchase_cash',15,3);//salida de efectivo nota debito compras
            //$table->decimal('out_ndpurchase',15,3);//salida total por nota debito compras
            $table->decimal('ndpurchase',15,3);//total de notas debito compras

            //$table->decimal('out_ncinvoice_cash',15,3); //salida efectivo notas credito ventas
            //$table->decimal('out_ncinvoice',15,3); //salida total por notas credito ventas
            $table->decimal('ncinvoice',15,3);//total de notas credito ventas


            $table->string('verification_code_open',12);//codigo verif apertura de caja
            $table->string('verification_code_close',12)->nullable();//cod verif cierre de caja
            $table->enum('status', ['open', 'close'])->default('open');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->foreignId('sale_point_id')->constrained();
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
