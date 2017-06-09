<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';

    use Notifiable;
    use ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'apellido', 'nombre', 'lugarNacimiento', 'fechaNacimiento', 'celular', 'telefono', 'direccion', 'sexo', 'foto', 'fechaIngresoUtc', 'nacionalidad', 'cargaFamiliar', 'estadoCivil', 'facultad', 'carrera', 'email', 'password'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',

    ];

//Un docente pose varios titulos
    public function titulos()
    {
        return $this->hasMany('App\Titulo', 'idDoc', 'id');

    }

//Un docente pose varios portafolios
    public function portafolios()
    {
        return $this->hasMany('App\Portafolio', 'idDoc', 'id');

    }

    // public function getRolAttribute()
    //  {
    //     $idRols    = $this->idRol;
    //    $nombreRol = "";
    //    if ($idRols == 1) {
    //          $nombreRol = "DOCENTE";
    //    }

    //   if ($idRols == 2) {
    //      $nombreRol = "COORDINADOR";
    //   }

    //   if ($idRols == 3) {
    //     $nombreRol = "DECANO";
    //   }

    //   return $nombreRol;
    //}

    public function getUsuarioAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getIdDocAttribute()
    {
        return $this->id;
    }

    public function getFotosAttribute()
    {
        return $this->foto;

    }

}
