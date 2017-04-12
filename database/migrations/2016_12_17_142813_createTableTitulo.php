<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTitulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //Relacion de una a varios usuarios tiene varios estudio
     Schema::create('titulo', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('idDoc')->unsigned(); 
            $table->index('idDoc'); 
            $table->foreign('idDoc')->references('id')->on('users')->onDelete('cascade');
            $table->integer('idNivel');
            $table->string('nombre',500);
            $table->string('fechaRegistro');
            $table->string('codigoRegistro',500);
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
       Schema::dropIfExists('titulo');
    }
}
