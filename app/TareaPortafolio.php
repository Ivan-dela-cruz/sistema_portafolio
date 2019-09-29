<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaPortafolio extends Model
{
    protected $table = "tarea_portafolios";


    public function periodo()
    {
        return $this->belongsTo('App\Periodo', 'id');
    }
}
