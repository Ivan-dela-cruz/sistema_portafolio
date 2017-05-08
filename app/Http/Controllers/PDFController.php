<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Nivel;
use App\Parametro;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Storage;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function get($id)
    {

        //$rutaPdf="pdfconsolidado/hojadevida";

        $idDoc = base64_decode($id);

        $users  = User::find($idDoc);
        $nivels = Nivel::all();
        $titulo = $users->titulos();

        $pdf = PDF::loadView('pdf.perfil', ['users' => $users, 'nivel' => $nivels, 'titulo' => $titulo]);
        return $pdf->stream('perfil.pdf');

        //if($tipo==1){return $pdf->stream('perfil.pdf');}
        //if($tipo==2){return $pdf->download('perfil.pdf'); }

    }

    public function descargar($id)
    {

        $idDoc = base64_decode($id);

        $users  = User::find($idDoc);
        $nivels = Nivel::all();
        $titulo = $users->titulos();
        $pdf    = PDF::loadView('pdf.perfil', ['users' => $users, 'nivel' => $nivels, 'titulo' => $titulo]);
        //Nombre del pDf
        return $pdf->download('perfil.pdf');
    }

    public function generarReporteCumplimiento($idPorta, $idPorMat)
    {

        //PARA EL MENBRETE

        $portafolio = DB::table('portafolio')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->join('carrera', 'carrera.id', '=', 'portafolio.idCar')->join('users', 'users.id', '=', 'portafolio.idDoc')->where('portafolio.id', '=', $idPorta)->select('periodo.*', 'portafolio.nombre as portafolio', 'carrera.nombre as carrera', 'users.nombre as nombreDoc', 'users.apellido as apellidoDoc')->first();

        //dd($portafolio);
        //Para consultar ciclo paralelo Asignatura

        $materiasCreadas = DB::table('portafolio')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where('portafolio.id', '=', $idPorta)->where('portafolio_materia.id', '=', $idPorMat)->select('portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia')->first();

        //Para consultar los parametros de cada una de las materia para geneera el reporte
        $parametroMateria = DB::table('portafolio_materia')->join('documento', 'portafolio_materia.id', '=', 'documento.idPorMat')->join('parametro', 'parametro.id', '=', 'documento.idPar')->where('portafolio_materia.id', '=', $idPorMat)->select('parametro.nombre as nombrePar', 'documento.urlArchivo as url')->get();

        $parametro = Parametro::all();

        $pdf = PDF::loadView('Coordinador.generarReporteCumplimiento', ['portafolio' => $portafolio, 'asignaturas' => $materiasCreadas, 'parametros' => $parametroMateria, 'parametro' => $parametro]);

        return $pdf->stream('Reporte_Cumplimiento.pdf');

    }

    public function index()
    {

        return view("pdf.listado_reportes");
    }

    public function reporteVerificacion($idPorta, $idPorMat)
    {

        //Para el membrete

        $materiasCreadas = DB::table('portafolio')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where('portafolio_materia.id', '=', $idPorMat)->select('portafolio_materia.idPor as idPortafolio', 'portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia')->first();

//Consultar todos los paramtros que poseen la materia

        $parametroMate = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->select("documento.*", "parametro.nombre")->get();

//Tambien ontenemos el id del portafolio

//Obtener el idPortafolio

        // dd($materiasCreadas->idPortafolio);
        //Para obtener el periodo y carrera del portafolio

        $portaDatos = DB::table("portafolio")->join("users", "users.id", "=", "portafolio.idDoc")->join("carrera", "carrera.id", "=", "portafolio.idCar")->join("periodo", "periodo.id", "=", "portafolio.idPer")->where("portafolio.id", "=", $idPorta)->select("periodo.desde as desde", "periodo.hasta as hasta", "carrera.nombre as carrera", "users.nombre as nombreDoc", "users.apellido as apellidoDoc")->first();

        //  dd($portaDatos->desde . "-" . $portaDatos->hasta . "-" . $portaDatos->carrera);

        if (count($parametroMate)) {
            return view("Coordinador.reporteVerificacion")->with("idPorta", $idPorta)->with("idPorMat", $idPorMat)->with("parametrosMateria", $parametroMate)->with("membrete", $materiasCreadas)->with("portafolio", $portaDatos);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existen parametros registrados:");
        }

    }

    public function eliminarPdf($idArchivo)
    {
        $documento = Documento::find($idArchivo);
        $idPorMat  = $documento->idPorMat;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();

            $parametroMate = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->select("documento.*", "parametro.nombre")->get();

            return view("Coordinador.actualizarArchivoVerificacion")->with("parametrosMateria", $parametroMate);

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error archivo no existe intente nuevamente :");
        }

//Eliminar archivo PDF en php normal
        //  if (unlink($archivo)) {
        //     dd("Eliminado");
        //} else {
        //     dd("No hay");
        //   }

        //  dd($result);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
