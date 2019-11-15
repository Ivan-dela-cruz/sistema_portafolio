<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_periodo')->unsigned();
            $table->string('titulo');
            $table->mediumText('descripcion')->nullable();
            $table->string('url_pdf')->nullable();
            $table->string('url_doc')->nullable();
            $table->string('url_xls')->nullable();
            $table->boolean('estado')->default(true);;
            $table->timestamps();

            $table->foreign('id_periodo')->references('id')->on('periodo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos');
    }
}
