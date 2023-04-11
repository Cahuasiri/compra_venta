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
        Schema::create('datos_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('logo')->nullable();
            $table->string('nit')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('compra_referencia')->nullable();
            $table->string('venta_referencia')->nullable();
            $table->string('coti_referencia')->nullable();
            $table->string('moneda')->nullable();
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('datos_empresa');
    }
};
