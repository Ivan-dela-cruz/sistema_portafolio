<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table='periodo';


    public function tareas(){

        $this->hasOne('App\TareaPortafolio');
    }
}
