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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('grupo_cliente_id');
            $table->foreign('grupo_cliente_id')->references('id')->on('grupo_clientes');

            $table->string('nombre_empresa');
            $table->string('nombre_cliente');
            $table->string('email');
            $table->string('nit_ci')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();

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
        Schema::dropIfExists('clientes');
    }
};
