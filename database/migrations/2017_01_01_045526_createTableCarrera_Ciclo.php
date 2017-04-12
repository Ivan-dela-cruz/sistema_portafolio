<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCarreraCiclo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
  Schema::create('carrera_ciclo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCar')->unsigned();
            $table->index('idCar'); 
            $table->foreign('idCar')->references('id')->on('carrera')->onDelete('cascade');
            $table->integer('idCic')->unsigned();
            $table->index('idCic'); 
            $table->foreign('idCic')->references('id')->on('ciclo')->onDelete('cascade');
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
        Schema::dropIfExists('carrera_ciclo');
    }
}
