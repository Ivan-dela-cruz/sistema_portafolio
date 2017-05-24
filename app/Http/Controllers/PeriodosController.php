<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();
        return view("Decano.agregarperiodoDecano")->with("periodo", $periodo);

    }

    public function listaPeriodoRegistradoPortafolio()
    {

        $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();
        return view("Decano.listaPeriodoA")->with("periodo", $periodo);

    }

    public function crearPeriodo(Request $request)
    {
//User es un metodo declarado para obtener todos los campos del docente logueado

        // $fecha = $request->input("desdePeriodo");
        //$año  = $request->input("desdePeriodos");
        //$desde = $fecha . '-' . $año;

        //$fechah = $request->input("hastaPeriodo");
        //$añoh  = $request->input("hastaPeriodos");
        //$hasta  = $fechah . '-' . $añoh;

        $fechaInicio = $request->input("mes_anio_inicio");

        $fechaFin = $request->input("mes_anio_fin");

//        dd($fechaInicio . $fechaFin);

        $verificaperiodo = DB::table('periodo')->where('periodo.desde', '=', $fechaInicio)->Where('periodo.hasta', '=', $fechaFin)->select('periodo.desde')->get();

        if (!count($verificaperiodo)) {
            $periodo        = new Periodo;
            $periodo->desde = $fechaInicio;
            $periodo->hasta = $fechaFin;
            $periodo->save();

            //       echo "<div class='alert alert-info'>
            //     <strong>Periodo </strong>registrado correctamente en el portafolio Docente..
            //</div>";
            $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();
            return view("mensajes.msj_correcto")->with("periodo", $periodo)->with("msj", "Período Académico registrado correctamente ");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Período Académico ya se encuentra registrado ");
        }

    }

    public function actualizarPeriodo(Request $request)
    {
        $idPeriodo   = $request->input("idPeriodo");
        $fechaInicio = $request->input("mes_anio_inicio2");
        $fechaFin    = $request->input("mes_anio_fin2");

        $periodo = Periodo::find($idPeriodo);

        if ($periodo) {
            $periodo->desde = $fechaInicio;
            $periodo->hasta = $fechaFin;
            $periodo->save();
            return view("mensajes.msj_correcto")->with("msj", "Período Académico actualizado correctamente ");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un error intente nuevamente ");
        }

    }

}
