<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos';

    public function periodo(){

        return $this->belongsTo('App\Periodo','id_periodo');
    }
}
