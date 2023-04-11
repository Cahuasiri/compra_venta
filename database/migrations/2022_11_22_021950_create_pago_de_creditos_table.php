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
        Schema::create('pago_de_creditos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('id')->on('compra_productos');

            $table->double('monto', 8,2)->default(0);
            $table->date('fecha_pago')->nullable();
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
        Schema::dropIfExists('pago_de_creditos');
    }
};
