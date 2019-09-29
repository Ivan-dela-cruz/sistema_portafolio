<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Documento_Actividad;
use App\Documento_Materia;
use App\Documento_Portafolio;
use App\Nivel;
use App\Parametro;
use App\Portafolio_Materia;
use App\Producto_Academico;
use App\TareaPortafolio;
use App\User;
use Carbon\Carbon;
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

        $users = User::find($idDoc);
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

        $users = User::find($idDoc);
        $nivels = Nivel::all();
        $titulo = $users->titulos();
        $pdf = PDF::loadView('pdf.perfil', ['users' => $users, 'nivel' => $nivels, 'titulo' => $titulo]);
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

//Para consultar los parametros Asignatura
        $parametroMateria = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->select("documento_materia.*", "parametro.nombre")->get();

        //  dd($parametroMateria);

        //PARA CONSULTAR PARAMETROS portafolio
        $parametroPortafolio = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->where("documento_portafolio.idPor", "=", $idPorta)->select("documento_portafolio.*", "parametro.nombre as parametro")->get();

        // dd($parametroPortafolio);

        //Para consultar los parametros producto
        $parametroProducto = DB::table('portafolio_materia')->join('documento', 'portafolio_materia.id', '=', 'documento.idPorMat')->join('parametro', 'parametro.id', '=', 'documento.idPar')->where('portafolio_materia.id', '=', $idPorMat)->select('documento.idProAca as idProAca', 'parametro.nombre as nombrePar', 'documento.urlArchivo as url')->get();

        $parametro = Parametro::all();
        $productoAcademico = Producto_Academico::all();

        $pdf = PDF::loadView('Coordinador.generarReporteCumplimiento', ['portafolio' => $portafolio, 'asignaturas' => $materiasCreadas, 'parametroPorta' => $parametroPortafolio, 'parametroMat' => $parametroMateria, 'parametroPro' => $parametroProducto, 'parametro' => $parametro, 'productoAcademicoALL' => $productoAcademico]);

        return $pdf->stream('Reporte_Cumplimiento.pdf');

    }

    // public function index()
    //{

    //  return view("pdf.listado_reportes");
    //}

    public function reporteVerificacion($idPorta, $idPorMat)
    {

        //Para el membrete


        $materiasCreadas = DB::table('portafolio')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where('portafolio_materia.id', '=', $idPorMat)->select('portafolio_materia.idPor as idPortafolio', 'portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia')->first();

//Consultar todos los paramtros que poseen la materia

//Consultar todos los parametros Academicos registrados

        $productoAcademico = Producto_Academico::all();

        //Para consultar los parametros de las asignaturas

        $parametroMate = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->select("documento_materia.*", "parametro.nombre as parametro")->get();

//Para consultar los parametros de los productos
        $parametroProduc = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->select("documento.*", "parametro.nombre")->get();

//Tambien ontenemos el id del portafolio

//Obtener el idPortafolio

        // dd($materiasCreadas->idPortafolio);
        //Para obtener el periodo y carrera del portafolio

        $portaDatos = DB::table("portafolio")->join("users", "users.id", "=", "portafolio.idDoc")->join("carrera", "carrera.id", "=", "portafolio.idCar")->join("periodo", "periodo.id", "=", "portafolio.idPer")->where("portafolio.id", "=", $idPorta)->select("periodo.desde as desde", "periodo.hasta as hasta", "carrera.nombre as carrera", "users.nombre as nombreDoc", "users.apellido as apellidoDoc")->first();

        //  dd($portaDatos->desde . "-" . $portaDatos->hasta . "-" . $portaDatos->carrera);

//Para consultar los parametros portafolio

        if (count($parametroProduc)) {
            return view("Coordinador.reporteVerificacion")->with("idPorta", $idPorta)->with("idPorMat", $idPorMat)->with("productosAcademico", $productoAcademico)->with("parametrosMateria", $parametroMate)->with("parametrosProducto", $parametroProduc)->with("membrete", $materiasCreadas)->with("portafolio", $portaDatos);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existen parametros registrados:");
        }

    }

//Eliminar los archivos Pdf de tipo producto
    public function eliminarPdfProducto($idArchivo)
    {

        //Consultar los parametros portafolio
        $productoAcademico = Producto_Academico::all();

        $documento = Documento::find($idArchivo);
        //Para consultar nuevamente los parametros de los productos
        $idPorMat = $documento->idPorMat;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();

            $parametroProduc = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->select("documento.*", "parametro.nombre")->get();

            return view("Coordinador.actualizarArchivoVerificacion")
                ->with("productosAcademico", $productoAcademico)
                ->with("parametrosProducto", $parametroProduc);

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error archivo no existe intente nuevamente :");
        }

    }


//Eliminar los pdf de los oaramtros de tipo parametro portafolio
    public function eliminarPdfParametroPorta($idArchivo)
    {

        $documento = Documento_Portafolio::find($idArchivo);

        //Para consultar el id del portafolio pra consultar nuevamente los parametros del portafolio
        $idPorta = $documento->idPor;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();

//Para consultar los parametros del portafolio academico

            $parametroPortafolio = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->where("documento_portafolio.idPor", "=", $idPorta)->select("documento_portafolio.*", "parametro.nombre as parametro")->get();
            //  dd($parametroPortafolio);

            return view("Coordinador.parametroPortafolio")->with("parametroPortafolio", $parametroPortafolio);

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

//Eliminar los pdf de los parametros Materias
    public function eliminarPdfParametroMate($idArchivo)
    {

        $documento = Documento_Materia::find($idArchivo);

        //Para consultar el id del portafolio_m<teria pra consultar nuevamente los parameros de la asignatura
        $idPorMat = $documento->idPorMat;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();

            //Para consultar los parametros  de la materia

            $parametroMateria = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->select("documento_materia.*", "parametro.nombre as parametro")->get();

            return view("Coordinador.parametroMateria")->with("parametrosMateria", $parametroMateria);

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error archivo no existe intente nuevamente :");
        }


    }

    public function eliminarPdfActividad($idArchivo)
    {
        $documento = Documento_Actividad::find($idArchivo);

        //Para consultar el id del portafolio_m<teria pra consultar nuevamente los parameros de la asignatura
        $idPorMat = $documento->idPorMat;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();

            return view("mensajes.msj_correcto")->with("msj", "Archivo PDF eliminado exitosamente ");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error archivo no existe intente nuevamente :");
        }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Eliminar los pdf de los parametros Materias
    public function eliminarPdfParametroAsignaturaDocente($idArchivo)
    {

        $documento = Documento_Materia::find($idArchivo);

        //Para consultar el id del portafolio_m<teria pra consultar nuevamente los parameros de la asignatura
        $idPorMat = $documento->idPorMat;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();


            // $parametroMateria = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->select("documento_materia.*", "parametro.nombre as parametro")->get();
            $parametroMateria = DB::table("portafolio_materia")
                ->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")
                ->join("parametro", "parametro.id", "=", "documento_materia.idPar")
                ->where("documento_materia.idPorMat", "=", $documento->idPorMat)
                ->select("documento_materia.*", "parametro.nombre")->get();

            $portafolio_materia = Portafolio_Materia::find($documento->idPorMat);
            //Nombre del periodo actual segun el id portafolio
            $periodoActual = DB::table("periodo")->join("portafolio", "periodo.id", "=", "portafolio.idPer")
                ->where("portafolio.id", "=", $portafolio_materia->idPor)
                ->select("periodo.*")->first();
            // para consultar el tiempo de subida de tarea
            $tiempoTares = TareaPortafolio::find($periodoActual->id);
            //fecha y hora del servidor
            $hoy = Carbon::now();


            return view("Docente.actualizarSeccionPortada")
                ->with("idPorMat", $idPorMat)
                ->with("parametrosMateria", $parametroMateria)
                ->with("tiempoTares", $tiempoTares)
                ->with("hoy", $hoy);

        } else {
            return $documento;
        }


    }

    //Eliminar los archivos Pdf de tipo producto
    public function eliminarPdfProductoDocente($idArchivo)
    {

        //Consultar los parametros portafolio
        $productoAcademico = Producto_Academico::all();

        $documento = Documento::find($idArchivo);
        //Para consultar nuevamente los parametros de los productos
        $idPorMat = $documento->idPorMat;
        //Ruta del archivo
        $archivo = $documento->urlArchivo;
        //Eliminar archivo;

        $rs = File::delete($archivo);

        if ($rs) {
            $documento->urlArchivo = "";
            $documento->save();

            $productosAca = Producto_Academico::all();


            $parametroProducto = DB::table("portafolio_materia")
                ->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")
                ->join("parametro", "parametro.id", "=", "documento.idPar")
                ->where("documento.idPorMat", "=", $idPorMat)
                ->select("documento.*", "parametro.nombre")
                ->get();
            $portafolio_materia = Portafolio_Materia::find($documento->idPorMat);
            //Nombre del periodo actual segun el id portafolio
            $periodoActual = DB::table("periodo")->join("portafolio", "periodo.id", "=", "portafolio.idPer")
                ->where("portafolio.id", "=", $portafolio_materia->idPor)
                ->select("periodo.*")->first();
            // para consultar el tiempo de subida de tarea
            $tiempoTares = TareaPortafolio::find($periodoActual->id);


            //fecha y hora del servidor
            $hoy = Carbon::now();

            return view("Docente.actualizarSeccionAsignatura")
                ->with("idPorMat", $idPorMat)
                ->with("parametrosProducto", $parametroProducto)
                ->with("productosAll", $productosAca)
                ->with("tiempoTares", $tiempoTares)
                ->with("hoy", $hoy);

        } else {
            ///return view("mensajes.msj_rechazado")
            ///   ->with("msj", "Error archivo no existe intente nuevamente :");
        }

    }
}
