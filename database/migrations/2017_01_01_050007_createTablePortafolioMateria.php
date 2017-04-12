<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePortafolioMateria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('portafolio_materia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPor')->unsigned();
           
            $table->index('idPor'); 
            $table->foreign('idPor')->references('id')->on('portafolio')->onDelete('cascade');
            
            $table->integer('idPar')->unsigned();
            $table->index('idPar'); 
            $table->foreign('idPar')->references('id')->on('paralelo')->onDelete('cascade');


            $table->integer('idMat')->unsigned();
            $table->index('idMat'); 
            $table->foreign('idMat')->references('id')->on('materia')->onDelete('cascade');
            
            $table->string('nombreMateria',200);
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
        Schema::dropIfExists('portafolio_materia');

    }
}
