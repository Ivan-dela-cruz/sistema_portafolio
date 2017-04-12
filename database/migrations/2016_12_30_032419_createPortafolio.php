<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortafolio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('portafolio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPer')->unsigned();
            $table->index('idPer'); 
            $table->foreign('idPer')->references('id')->on('periodo')->onDelete('cascade');
            $table->integer('idCar')->unsigned();
            $table->index('idCar'); 
            $table->foreign('idCar')->references('id')->on('carrera')->onDelete('cascade');
            $table->integer('idDoc')->unsigned(); 
            $table->index('idDoc'); 
            $table->foreign('idDoc')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombre',500);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('portafolio');
    }
}
