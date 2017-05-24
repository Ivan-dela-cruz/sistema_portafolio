<?php

namespace App\Http\Controllers;

use App\Parametro;
use App\Tipo_Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function crearParametro(Request $request)
    {
//User es un metodo declarado para obtener todos los campos del docente logueado

        $tipo_parametro   = $request->input("tipo_parametro");
        $nombre_parametro = $request->input("nombre_parametro");
        //    $comparar = $request->input("nombreParametro");

//Verificar si se encuentra creado el parametro
        $verificarParametroPortafolio = DB::table('parametro')->where('parametro.nombre', '=', $nombre_parametro)->where("parametro.idTipPar", "=", $tipo_parametro)->select('parametro.nombre')->get();

        if (!count($verificarParametroPortafolio)) {
            $parametro           = new Parametro;
            $parametro->nombre   = $nombre_parametro;
            $parametro->idTipPar = $tipo_parametro;
            $parametro->save();

            return view("mensajes.msj_correcto")->with("msj", "Parámetro registrado correctamente en el portafolio.");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Parámetro ya se encuentra registrado en el portafolio.");

        }

    }

    public function consultarParametro()
    {
        $tipoParametro = Tipo_Parametro::all();
        $parametro     = Parametro::all();

        return view("Decano.parametrosDecano")->with("tipoParametros", $tipoParametro)->with("parametro", $parametro);

    }

    public function parametroRegistradaPortafolio()
    {
        $tipoParametro = Tipo_Parametro::all();
        $parametros    = Parametro::all();
        return view("Decano.listadoParametro")->with("tipoParametros", $tipoParametro)->with("parametro", $parametros);
    }

    public function delete($id)
    {
        $parametro = Parametro::find($id);
        $parametro->delete();
        $tipoParametro = Tipo_Parametro::all();
        $parametros    = Parametro::all();
        return view("Decano.listadoParametro")->with("tipoParametros", $tipoParametro)->with("parametro", $parametros);

    }

    public function update(Request $request)
    {
        $idParametro     = $request->input("idParametro");
        $nombreParametro = $request->input("nombreParametro");

//Verifica
        $repiteparametro = DB::select('select * from parametro where nombre = ?', [$nombreParametro]);

        if (!count($repiteparametro)) {
            DB::update('update parametro set nombre = ? where id = ?', [$nombreParametro, $idParametro]);

            return view("mensajes.msj_correcto")->with("msj", "Parámetro actualizado correctamente .");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Parámetro ya se encuentra registrado en el portafolio.");

        }
    }

}
