<?php

namespace App\Http\Controllers;

use App\Periodo;
use App\Portafolio;
use App\TareaPortafolio;
use Carbon\Carbon;
use http\Env\Response;
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


    public function listarPeriodoAcademico()
    {

        $idUsuarioActual = \Auth::user()->id;

        //dd($id);
        //Consulta todos los periodo en forma decendente
        $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();
        $tiempoTarea = TareaPortafolio::orderBy('created_at','ASC')->paginate(3);

        $contador = count($idUsuarioActual);
        if ($contador) {
            return view("Docente.HabilitarTareaPeriodo")->with("periodo", $periodo)->with("tiempoTarea", $tiempoTarea);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existe registrado ningun Período Académico .");
        }

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
            $periodo = new Periodo;
            $periodo->desde = $fechaInicio;
            $periodo->hasta = $fechaFin;
            $periodo->save();
            ///registra el tiempo de carga de tarea por defecto cuando un portafolio se crea
            $this->registrarTiempoCargaArchivosPortafolio($periodo->id, null, null, null, null);

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
        $idPeriodo = $request->input("idPeriodo");
        $fechaInicio = $request->input("mes_anio_inicio2");
        $fechaFin = $request->input("mes_anio_fin2");

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


    public function registrarTiempoCargaArchivosPortafolio($idPorta, $fechafinPortada, $horafinPortada, $fechafinMateria, $horafinMateria)
    {
        $tiempoCarga = new  TareaPortafolio();

        $tiempoCarga->id = $idPorta;
        $tiempoCarga->fecha_fin_portada = $fechafinPortada;
        $tiempoCarga->hora_fin_portada = $horafinPortada;

        $tiempoCarga->fecha_fin_materia = $fechafinMateria;
        $tiempoCarga->hora_fin_materia = $horafinMateria;

        $tiempoCarga->save();

        return $tiempoCarga;

    }

    public function habilitarSubidaDocumetos(Request $request)
    {
        $idTarea = $request->input('id_tarea');

        $fecha_fin = $request->input('fecha_fin');
        $hora_fin = $request->input('hora_fin');
        $fecha_fin_par = $request->input('fecha_fin_par');
        $hora_fin_par = $request->input('hora_fin_par');

        $tareaPorta = TareaPortafolio::find($idTarea);
        $periodo = Periodo::find($idTarea);

        $fechaTareaCreada = Carbon::parse($periodo->created_at)->format('Y-m-d');

        if (isset($tareaPorta)) {
            if ($fecha_fin >= $fechaTareaCreada && $fecha_fin_par >= $fechaTareaCreada) {

                $tareaPorta->fecha_fin_portada = $fecha_fin;
                $tareaPorta->hora_fin_portada = $hora_fin;
                $tareaPorta->fecha_fin_materia = $fecha_fin_par;
                $tareaPorta->hora_fin_materia = $hora_fin_par;
                $tareaPorta->save();

                $periodo = $tareaPorta->periodo->desde . ' - ' . $tareaPorta->periodo->hasta;
                $msj = 'Tiempo de subida de documentos actualizado correctamente';
                return response()->json([
                    'msj' => $msj,
                    'id' => $tareaPorta->id,
                    'fecha_por' => $tareaPorta->fecha_fin_portada,
                    'hora_por' => $tareaPorta->hora_fin_portada,
                    'fecha_par' => $tareaPorta->fecha_fin_materia,
                    'hora_par' => $tareaPorta->hora_fin_materia,
                    'periodo' => $periodo

                ]);

                // return view("mensajes.divTiempo")->with("msj", "Tiempo de subida de documentos actualizado correctamente ")->with('tareaPorta', $tareaPorta);
            } else {
                return view("mensajes.msj_rechazado")->with("msj", "No se realizaron cambios la fecha es incorrecta ");
            }

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un error intente nuevamente ");
        }
    }

    public function getTiempoFechaPeriodo(Request $request)
    {
        $id = $request->id;
        $tareaPorta = TareaPortafolio::find($id);
        if (isset($tareaPorta)) {
            return $tareaPorta;
        } else {
            ///registra el tiempo de carga de tarea por defecto cuando un portafolio se crea

            $tareaPorta = $this->registrarTiempoCargaArchivosPortafolio($id, null, null, null, null);
            return $tareaPorta;
        }

    }


}
