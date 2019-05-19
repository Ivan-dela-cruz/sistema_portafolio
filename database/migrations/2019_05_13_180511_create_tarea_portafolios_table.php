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
            $table->string('estado',128);
            $table->date('fecha_fin');
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
