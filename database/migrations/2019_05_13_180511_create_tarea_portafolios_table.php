<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaPortafoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_portafolios', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->date('fecha_fin_portada')->nullable();
            $table->time('hora_fin_portada')->nullable();
            $table->date('fecha_fin_materia')->nullable();
            $table->time('hora_fin_materia')->nullable();
            $table->timestamps();

            $table->foreign('id')->references('id')->on('periodo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarea_portafolios');
    }
}
