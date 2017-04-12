<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idRol')->unsigned();
            $table->index('idRol'); 
            $table->foreign('idRol')->references('idRol')->on('rol')->onDelete('cascade');
            $table->string('cedula',10)->unique();
            $table->string('apellido',200);
            $table->string('nombre',200);
            $table->string('lugarNacimiento',200);
            $table->string('fechaNacimiento');
            $table->string('celular',10)->unique()->nullable();
            $table->string('telefono',9)->unique()->nullable();
            $table->string('direccion',500);
            $table->integer('sexo');
            $table->string('foto',200);
            $table->string('fechaIngresoUtc',200);
            $table->integer('nacionalidad');
            $table->integer('cargaFamiliar');
            $table->integer('estadoCivil');
            $table->integer('facultad');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
