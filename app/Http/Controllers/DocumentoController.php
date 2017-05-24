<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Documento_Materia;
use App\Documento_Portafolio;
use App\Producto_Academico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

//Subir archivos parametrios Productos

    public function subirArchivoPdf(Request $request)
    {

//Id del documento a editar
        $idDocumento = $request->input("documento");
        $descripcion = $request->input("descripcion");

        $archivo = $request->file('file');
        $input   = array('documento' => $archivo);
        $reglas  = array('documento' => 'required|mimes:pdf|max:1000');

        $validar = Validator::make($input, $reglas);

        if ($validar->fails()) {
            return view("mensajes.mensaje_error")->withErrors($validar->errors());

        }

        $nombre_original = $archivo->getClientOriginalName();
        $extension       = $archivo->getClientOriginalExtension();

        $nuevo_nombrePdf = "Parametro-" . $descripcion . "-" . $idDocumento . "." . $extension;

        //Nombre del disco creado en filesSytem
        $r1 = Storage::disk('archivo')->put($nuevo_nombrePdf, \File::get($archivo));

        $rutaPdf = "storage/archivo/" . $nuevo_nombrePdf;

        if ($r1) {
            $documentos              = Documento::find($idDocumento);
            $documentos->descripcion = $descripcion;

            $documentos->urlArchivo = $rutaPdf;

            $documentos->save();
            return view("mensajes.msj_correcto")->with("msj", "Archivo en formato PDF guardado correctamente");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", " Error vuelva a intentar :");
        }

        //$nuevo_nombre="fotoUser-".$id.".".$extension;
        //$carpeta="PDF";
        //         $ruta=$carpeta."/".$request->input("id_usuario")."_".$archivo->getClientOriginalName();
        //       $r1=Storage::disk('archivos')->put($ruta,  \File::get($archivo) );
        //     $proyecto->ruta=$ruta;

    }

// Para subir los archivos Parametros Materia

    public function subirArchivoPdfParametro(Request $request)
    {

        $idDocumento = $request->input("documento");
        $descripcion = $request->input("descripcion");

        $archivo = $request->file('file');
        $input   = array('documento' => $archivo);
        $reglas  = array('documento' => 'required|mimes:pdf|max:1000');

        $validar = Validator::make($input, $reglas);

        if ($validar->fails()) {
            return view("mensajes.mensaje_error")->withErrors($validar->errors());

        }

        $nombre_original = $archivo->getClientOriginalName();
        $extension       = $archivo->getClientOriginalExtension();

        $nuevo_nombrePdf = "ParametroAsignatura-" . $descripcion . "-" . $idDocumento . "." . $extension;

        //Nombre del disco creado en filesSytem
        $r1 = Storage::disk('archivo')->put($nuevo_nombrePdf, \File::get($archivo));

        $rutaPdf = "storage/archivo/" . $nuevo_nombrePdf;

        if ($r1) {
            $documentosAsignatura              = Documento_Materia::find($idDocumento);
            $documentosAsignatura->descripcion = $descripcion;

            $documentosAsignatura->urlArchivo = $rutaPdf;

            $documentosAsignatura->save();
            return view("mensajes.msj_correcto")->with("msj", "Archivo en formato PDF guardado correctamente");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", " Error vuelva a intentar :");
        }

    }

//para subir los parametros Pdf Portafolio
    public function subirArchivoPdfParametroPorta(Request $request)
    {

        $idDocumento = $request->input("documento");
        $descripcion = $request->input("descripcion");

        $archivo = $request->file('file');
        $input   = array('documento' => $archivo);
        $reglas  = array('documento' => 'required|mimes:pdf|max:1000');

        $validar = Validator::make($input, $reglas);

        if ($validar->fails()) {
            return view("mensajes.mensaje_error")->withErrors($validar->errors());

        }

        $nombre_original = $archivo->getClientOriginalName();
        $extension       = $archivo->getClientOriginalExtension();

        $nuevo_nombrePdf = "ParametroPortafolio-" . $descripcion . "-" . $idDocumento . "." . $extension;

        //Nombre del disco creado en filesSytem
        $r1 = Storage::disk('archivo')->put($nuevo_nombrePdf, \File::get($archivo));

        $rutaPdf = "storage/archivo/" . $nuevo_nombrePdf;

        if ($r1) {
            $documentosPortafolio              = Documento_Portafolio::find($idDocumento);
            $documentosPortafolio->descripcion = $descripcion;

            $documentosPortafolio->urlArchivo = $rutaPdf;

            $documentosPortafolio->save();
            return view("mensajes.msj_correcto")->with("msj", "Archivo en formato PDF guardado correctamente");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", " Error vuelva a intentar :");
        }

    }

    public function generarPdfConsolidado($idPorMats)
    {

        //Consultar los cuatro productos Academicos
        $productosAcademicos = Producto_Academico::all();

        //  dd($productosAcademicos);
        //Para deseccripar
        $idPorMat = base64_decode($idPorMats);

        // dd($idPorMat);
        //Para obtener datos de la portada es decir el periodo y nombre de la carrera y el nombre y apellido docente
        $portadaPortafolio = DB::table('carrera')->join('portafolio', 'carrera.id', '=', 'portafolio.idCar')->join('users', 'users.id', '=', 'portafolio.idDoc')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->where('portafolio_materia.id', '=', $idPorMat)->select('carrera.nombre', 'periodo.*', 'users.nombre as nomDoc', 'users.apellido as apeDoc')->first();

        //   dd($portadaPortafolio->nomDoc . "-" . $portadaPortafolio->apeDoc);

//dd($portadaPortafolio);
        //Para el ciclo y paralelo nombre asignatura

        $asignatura = DB::table('portafolio')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where('portafolio_materia.id', '=', $idPorMat)->select('portafolio_materia.idPor as idPortafolio', 'portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia')->first();

//Para los Documentos que poseen los productos los parametros y archivo
        $documentoPortafolio = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->select("documento.*", "parametro.nombre as parametro")->get();

//pRA CONSULTA LOS DOCUMENTOS QUE POREEN LOS PARAMETROS ASIGNATURA
        $docuAsignatura = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->select("documento_materia.*", "parametro.nombre as parametroMat")->get();

        //dd($documentoPortafolio);
        return view("Docente.generar")->with('portada', $portadaPortafolio)->with("asignatura", $asignatura)->with('documento', $documentoPortafolio)->with('idPortafolio', $idPorMat)->with("productoAll", $productosAcademicos)->with("documentosAsiPara", $docuAsignatura);
    }

//Descargar Pdf parametros Producto
    public function descargarPdf($idDocu)
    {
        $documento = Documento::find($idDocu);
        $rutaPdf   = $documento->urlArchivo;
        return response()->download($rutaPdf);
    }

//Descargar Parametris Pdf Asignatura
    public function descargarPdfParametroMat($idDocu)
    {
        $documento = Documento_Materia::find($idDocu);
        $rutaPdf   = $documento->urlArchivo;
        return response()->download($rutaPdf);
    }

//Descargar archovos PDF  ParametTROS del portafolios
    public function descargarPdfParametroPorta($idDocu)
    {
        $documento = Documento_Portafolio::find($idDocu);
        $rutaPdf   = $documento->urlArchivo;
        return response()->download($rutaPdf);
    }

    public function actualizarParametroPorta($idPorta)
    {

        $parametroPortafolio = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->where("documento_portafolio.idPor", "=", $idPorta)->select("documento_portafolio.*", "parametro.nombre as parametro")->get();

        return view("Docente.mostrarParametroPortafolio")->with("parametrosPorta", $parametroPortafolio);

    }

}
