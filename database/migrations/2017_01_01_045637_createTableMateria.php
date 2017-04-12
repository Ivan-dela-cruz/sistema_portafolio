<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMateria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('materia', function (Blueprint $table) {
            $table->increments('id');
          $table->integer('idCarCic')->unsigned();
            $table->index('idCarCic'); 
            $table->foreign('idCarCic')->references('id')->on('carrera_ciclo')->onDelete('cascade');
            $table->string('nombre',200);
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
        Schema::dropIfExists('materia');
    }
}
