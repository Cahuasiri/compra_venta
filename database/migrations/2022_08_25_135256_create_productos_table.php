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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('barCodigo');

            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->unsignedBigInteger('sub_categoria_id');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias');

            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas');

            $table->unsignedBigInteger('unidad_producto_id');
            $table->foreign('unidad_producto_id')->references('id')->on('unidad_productos');

            $table->string('nombre_producto');
            $table->string('slug')->unique();            

            $table->integer('stock')->nullable();
            $table->string('imagen')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('usuario_id')->nullable();
            $table->char('estado',2)->default('A');

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
        Schema::dropIfExists('productos');
    }
};
