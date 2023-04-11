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
        Schema::create('compra_productos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('referencia');

            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');

            $table->unsignedBigInteger('almacen_id');
            $table->foreign('almacen_id')->references('id')->on('almacenes');

            $table->unsignedBigInteger('tipo_pago_id');
            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pagos');

            $table->double('impuesto',8,2)->default('0.0');
            $table->double('descuento',8,2)->default('0.0');
            $table->string('nro_banco')->nullable();
            $table->string('nro_cheque')->nullable();
            $table->date('fecha_limite_pago')->nullable();

            $table->double('sub_total',8,2);
            $table->double('monto_pagado',8,2)->default('0.0');
            $table->double('total',8,2);
            $table->string('descripcion')->nullable();
            $table->integer('usuario_id')->nullable();            
                     
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
        Schema::dropIfExists('compra_productos');
    }
};
