<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDocumentoPortafolio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_portafolio', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idPor')->unsigned();
            $table->index('idPor');
            $table->foreign('idPor')->references('id')->on('portafolio')->onDelete('cascade');

            $table->integer('idPar')->unsigned();
            $table->index('idPar');
            $table->foreign('idPar')->references('id')->on('parametro')->onDelete('cascade');

            $table->string('descripcion', 200);
            $table->string('urlArchivo', 500);
            $table->string('tipo', 200);
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
        Schema::dropIfExists('documento_portafolio');
    }
}
