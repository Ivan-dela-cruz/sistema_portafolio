<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Categoria;
use App\Documento_Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;
use Storage;

class ActividadController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function otrasActividades()
    {

        //Consulta todos los periodo en forma decendente
        $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();
        $carrera = Carrera::all();
        return View("Docente.otrasActividades")->with("carrera", $carrera)->with("periodo", $periodo);
    }

    public function buscarActividad($idPeriodo, $idCarrera)
    {
        //dd($idPeriodo . $idCarrera);
        $idUsuarioactual = \Auth::user();
//Consulta solo el id del Docente logeado
        $idDoc = $idUsuarioactual->id;

        $otraActividadPortafolio = DB::table('users')->join("portafolio", "users.id", "=", "portafolio.idDoc")->join("carrera", "carrera.id", "=", "portafolio.idCar")->join("periodo", "periodo.id", "=", "portafolio.idPer")->where("periodo.id", "=", $idPeriodo)->where("carrera.id", "=", $idCarrera)->where("users.id", "=", $idDoc)->select('portafolio.*')->get();
        if (!count($otraActividadPortafolio)) {
            return View("mensajes.msj_rechazado")->with("msj", "No existen actividades , Favor crear su Portafolio ");
        } else {

            return View("Docente.buscarActividad")->with("actividadPortafolio", $otraActividadPortafolio);
        }
    }

    public function archivoActividad($idPor)
    {
        $categoria = Categoria::all();
        $portada   = DB::table("portafolio")->join("periodo", "periodo.id", "=", "portafolio.idPer")->join("carrera", "carrera.id", "=", "portafolio.idCar")->where("portafolio.id", "=", $idPor)->select("carrera.nombre as carrera", "periodo.desde as inicio", "periodo.hasta as fin")->first();
        return View("Docente.archivoActividad")->with("idPorta", $idPor)->with("portada", $portada)->with("categoria", $categoria);

    }

    public function mostrarArchivoActividad($idPorta, $idCat)
    {

        $archivoCategoria = DB::table("categoria")->join("actividad", "categoria.id", "=", "actividad.idCat")->join("documento_actividad", "actividad.id", "=", "documento_actividad.idAct")->where("documento_actividad.idPor", "=", $idPorta)->where("categoria.id", "=", $idCat)->select("documento_actividad.*", "actividad.nombre as actividad ")->get();

        return View("Docente.mostrarArchivoActividad")->with("archivoCategoria", $archivoCategoria);

    }

//Subir archivos PDF EN ACTIVIDADES
    public function subirArchivoActividad(Request $request)
    {
        $idDocumento = $request->input("idActividad");
        $descripcion = $request->input("actividad");

        //    dd($idDocumento . $descripcion);

        $archivo = $request->file('file');
        $input   = array('documento' => $archivo);
        $reglas  = array('documento' => 'required|mimes:pdf|max:2000');

        $validar = Validator::make($input, $reglas);

        if ($validar->fails()) {
            return view("mensajes.mensaje_error")->withErrors($validar->errors());

        }

        $nombre_original = $archivo->getClientOriginalName();
        $extension       = $archivo->getClientOriginalExtension();
        // $nuevo_nombrePdf = "Actividad-Docencia" . $descripcion . "-" . $idDocumento . "." . $extension;

        $nuevo_nombrePdf = "Actividad-Docencia" . "-" . $idDocumento . "." . $extension;

        //Nombre del disco creado en filesSytem

        // $r1 = Storage::disk('archivo')->put($nuevo_nombrePdf, \File::get($archivo));

        //$rutaPdf = "storage/archivo/" . $nuevo_nombrePdf;

        $r1 = Storage::disk('actividad')->put(utf8_decode($nuevo_nombrePdf), \File::get($archivo));

        $rutaPdf = "storage/parametroActividad/" . $nuevo_nombrePdf;

        if ($r1) {
            $documentosActividad              = Documento_Actividad::find($idDocumento);
            $documentosActividad->descripcion = $descripcion;

            $documentosActividad->urlArchivo = $rutaPdf;

            $documentosActividad->save();
            return view("mensajes.msj_correcto")->with("msj", "Archivo en formato PDF guardado correctamente");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", " Error vuelva a intentar :");
        }

    }

    public function descargarPdfActividad($idDocu)
    {
        $documento = Documento_Actividad::find($idDocu);
        $rutaPdf   = $documento->urlArchivo;

        $parametro = DB::table("actividad")->join("documento_actividad", "actividad.id", "=", "documento_actividad.idAct")->where("documento_actividad.id", "=", $idDocu)->select("actividad.nombre as nombrePar")->first();

        return response()->download($rutaPdf, $parametro->nombrePar . ".pdf");
    }

    public function actividadReporteDocente($idPorta)
    {
        $categoria = Categoria::all();
        $portada   = DB::table("portafolio")->join("periodo", "periodo.id", "=", "portafolio.idPer")->join("carrera", "carrera.id", "=", "portafolio.idCar")->where("portafolio.id", "=", $idPorta)->select("carrera.nombre as carrera", "periodo.desde as inicio", "periodo.hasta as fin")->first();
        return View("Coordinador.actividadReporteDocente")->with("idPorta", $idPorta)->with("portada", $portada)->with("categoria", $categoria);

    }

    public function mostrarArchivoActividadDirector($idPorta, $idCat)
    {

        $archivoCategoria = DB::table("categoria")->join("actividad", "categoria.id", "=", "actividad.idCat")->join("documento_actividad", "actividad.id", "=", "documento_actividad.idAct")->where("documento_actividad.idPor", "=", $idPorta)->where("categoria.id", "=", $idCat)->select("documento_actividad.*", "actividad.nombre as actividad ")->get();

        return View("Coordinador.mostrarArchivoActividadDirector")->with("archivoCategoria", $archivoCategoria);

    }

    public function generarReporteActividad($idPorta)
    {

//Para el membrete

        $portafolio = DB::table("users")->join("portafolio", "users.id", "=", "portafolio.idDoc")->join("periodo", "periodo.id", "=", "portafolio.idPer")->join("carrera", "carrera.id", "=", "portafolio.idCar")->where("portafolio.id", "=", $idPorta)->select("periodo.*", "carrera.nombre as carrera", "users.nombre as nombreDoc", "users.apellido as apellidoDoc")->first();

        $categoria = Categoria::all();

        $actividad = DB::table("actividad")->join("documento_actividad", "actividad.id", "=", "documento_actividad.idAct")->where("documento_actividad.idPor", "=", $idPorta)->select("actividad.*", "documento_actividad.*")->get();

        $pdf = PDF::loadView('Coordinador.generarReporteActividad', ['portafolio' => $portafolio, 'categoria' => $categoria, 'actividad' => $actividad]);

        return $pdf->stream('Reporte_Actividad.pdf');
    }

}
