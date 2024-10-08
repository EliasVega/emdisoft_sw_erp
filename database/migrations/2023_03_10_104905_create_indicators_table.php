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

            $table->decimal('smlv',20,2);//salario minimo legal vigente
            $table->decimal('transport_assistance',10,2);//auxilio de trasporte
            $table->integer('weekly_hours'); //horas semanales
            $table->decimal('uvt',10,2);//unidad de valor tributario
            $table->decimal('plastic_bag_tax',10,2);//impuesto a las bolsas
            $table->enum('dian', ['on', 'off'])->default('off');//si o no envio electronico de documentos
            $table->enum('pos', ['on', 'off'])->default('on');//si o no habilitacion pos
            $table->enum('logo', ['on', 'off'])->default('on');//si o no maneja logo
            $table->enum('payroll', ['on', 'off'])->default('off');//si o no manejo de nomina
            $table->enum('work_labor', ['on', 'off'])->default('off');//pagos por obra labor
            $table->enum('accounting', ['on', 'off'])->default('off');//si o no manejo de contabilidad
            $table->enum('inventory', ['on', 'off'])->default('on');//si o no manejo de inventarios
            $table->enum('product_price', ['automatic', 'manual'])->default('automatic');//si o no manejo de precio de productos automatico
            $table->enum('raw_material', ['on', 'off'])->default('off');//si o  oo manejo de materias primas
            $table->enum('restaurant',['on', 'off'])->default('off');//si o no manejo de restaurantes
            $table->enum('barcode', ['on', 'off'])->default('off'); //si o no manejo codigo de barras
            $table->enum('cvpinvoice', ['on', 'off'])->default('off'); //Cambio de precio en venta
            $table->enum('sqio', ['on', 'off'])->default('off'); //si no tiene cantidad la orden de venta
            $table->enum('cmep', ['employee', 'product'])->default('employee'); //manejo de comision en empleados o productos
            $table->enum('imgp', ['on', 'off'])->default('off'); //maneja imagen en productos
            $table->enum('price_with_tax', ['on', 'off'])->default('off');//valor compimpuesto agregado

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
