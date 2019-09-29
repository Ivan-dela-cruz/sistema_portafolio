<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Carrera;
use App\Carrera_Ciclo;
use App\Ciclo;
use App\Documento;
use App\Documento_Actividad;
use App\Documento_Materia;
use App\Documento_Portafolio;
use App\Materia;
use App\Portafolio;
use App\Portafolio_Materia;
use App\Producto_Academico;
use App\TareaPortafolio;
use App\TiempoSubidaDocPorta;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use PDF;
use Storage;

class PortafoliosController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }


    public function consultarPortafolio()
    {

        $idUsuarioActual = \Auth::user()->id;

        //dd($id);
        //Consulta todos los periodo en forma decendente
        $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();

//Consulta el id  mayor en forma decendente
        $maxIdPeriodo = DB::table('periodo')->max('id');

        $portafolios = DB::table('users')->join('portafolio', 'users.id', '=', 'portafolio.idDoc')->join('carrera', 'carrera.id', '=', 'portafolio.idCar')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->where('periodo.id', '=', $maxIdPeriodo)->where('users.id', '=', $idUsuarioActual)->select('portafolio.*')
            ->get();

//Verifica Si existe carrera
        $verificaCarrera = Carrera::all();

        if (!count($verificaCarrera)) {
            $this->registrarCarrera(1, "Ingeniería Eléctrica");
            $this->registrarCarrera(2, "Ingeniería Industrial");
            $this->registrarCarrera(3, "Ingeniería en Electromecánica");
            $this->registrarCarrera(4, "Ingeniería en Informática y Sistemas Computacionales");
        }

        $carrera = Carrera::all();

        $contador = count($idUsuarioActual);
        if ($contador) {
            return view("Docente.consultaPortafolio")->with("periodo", $periodo)->with("portafolios", $portafolios)->with("carrera", $carrera);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existe registrado ningun Período Académico .");
        }

    }

    public function registrarCarrera($idCar, $nombreCar)
    {
        $carreras = new Carrera;
        $carreras->id = $idCar;
        $carreras->nombre = $nombreCar;
        $carreras->save();

    }

    public function buscarPortafolioXPeriodo($idPeriodo)
    {
        //User es un metodo declarado para obtener todos los campos del docente loueado
        $iduUsuarioactual = \Auth::user();

        $idPerActual = base64_decode($idPeriodo);

//Consulta solo el id del docente logueado
        $idDoc = $iduUsuarioactual->id;

        $portafolios = DB::table('users')->join('portafolio', 'users.id', '=', 'portafolio.idDoc')->join('carrera', 'carrera.id', '=', 'portafolio.idCar')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->where('periodo.id', '=', $idPerActual)->where('users.id', '=', $idDoc)->select('portafolio.*')
            ->get();

        return view('Docente.consultaPortafolioxPeriodo')
            ->with("portafolios", $portafolios);
    }

    public function crearPortafolio(Request $request)
    {
//User es un metodo declarado para obtener todos los campos del docente logueado
        //Reistrar Categorias

        $idUsuarioactual = \Auth::user();
//Consulta solo el id del Docente logeado
        $idDoc = $idUsuarioactual->id;

        $idCarrera = $request->input('carrera');
        $idPeriodo = $request->input('periodo');

        $verificarExistenPortafolio = DB::table('portafolio')
            ->join('users', 'users.id', '=', 'portafolio.idDoc')
            ->join('carrera', 'carrera.id', '=', 'portafolio.idCar')
            ->join('periodo', 'periodo.id', '=', 'portafolio.idPer')
            ->where('carrera.id', '=', $idCarrera)
            ->where('periodo.id', '=', $idPeriodo)
            ->where('users.id', '=', $idDoc)
            ->select('portafolio.*')->get();

//Si no existe se crea el portafolio
        if (!count($verificarExistenPortafolio)) {

            $portafolio = new Portafolio;
            $portafolio->idPer = $idPeriodo;
            $portafolio->idCar = $idCarrera;
            $portafolio->idDoc = $idDoc;
            $portafolio->nombre = $request->input("nombrePortafolio");
            $portafolio->save();
            $maxIdPoratafolio = DB::table('portafolio')->max('id');
            $this->registrarDocumentosActividades($maxIdPoratafolio, "", "", "");


        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Portafolio ya se encuentra creado para el Período Académico Seleccionado ..");
        }

        if (count($portafolio)) {
            return view("mensajes.msj_correcto")->with("msj", "Portafolio creado exitosamente:");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un error intente Nuevamente:");
        }

    }


    public function registrarDocumentosActividades($idPorta, $descripcion, $urlArchivo, $tip)
    {

        $actividad = Actividad::all();
        foreach ($actividad as $act) {

            $docAct = new Documento_Actividad;
            $docAct->idPor = $idPorta;
            $docAct->idAct = $act->id;
            $docAct->descripcion = $descripcion;
            $docAct->urlArchivo = $urlArchivo;
            $docAct->tipo = $tip;
            $docAct->save();
        }

    }

    public function registrarCiclo($idCic, $nombreCic)
    {
        $ciclo = new Ciclo;
        $ciclo->id = $idCic;
        $ciclo->nombre = $nombreCic;
        $ciclo->save();

    }

    //Eliminar los pdf de los oaramtros de tipo parametro portafolio
    public function eliminarPdfParametroPortaDocente($idArchivo)
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

            $parametrosPorta = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->where("documento_portafolio.idPor", "=", $idPorta)->select("documento_portafolio.*", "parametro.nombre as parametro")->get();
            //  dd($parametroPortafolio);

            return view("Docente.tableMateriasPortafolio")->with("parametrosPorta", $parametrosPorta);

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

    public function materiasPortafolio($idPor)
    {
        //  dd($idPor);
        //Verifica si ya se encuentran registrado los ciclos
        $ciclos = Ciclo::all();

        if (!count($ciclos)) {
            $this->registrarCiclo(1, "Primero");
            $this->registrarCiclo(2, "Segundo");
            $this->registrarCiclo(3, "Tercero");
            $this->registrarCiclo(4, "Cuarto");
            $this->registrarCiclo(5, "Quinto");
            $this->registrarCiclo(6, "Sexto");
            $this->registrarCiclo(7, "Séptimo");
            $this->registrarCiclo(8, "Octavo");
            $this->registrarCiclo(9, "Noveno");
            $this->registrarCiclo(10, "Décimo");
        }

//Consultar el nombre de portafolio
        $portafolio = Portafolio::find($idPor);

//Consulta el nombre del portafolio
        // dd($portafolio->nombre);

        //Nombre de la carrera segun el id del portafolio
        $carreraActual = DB::table("carrera")->join("portafolio", "carrera.id", "=", "portafolio.idCar")->where("portafolio.id", "=", $idPor)->select("carrera.*")->first();
//Nombre del periodo actual segun el id portafolio
        $periodoActual = DB::table("periodo")->join("portafolio", "periodo.id", "=", "portafolio.idPer")->where("portafolio.id", "=", $idPor)->select("periodo.*")->first();
// para consultar el tiempo de subida de tarea
        $tiempoTares = TareaPortafolio::find($periodoActual->id);

        $hoy = Carbon::now();

        //para consultar los parametros del prtafolioacademico docente

        $parametrosPorta = DB::table("tipo_parametro")->join("parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("parametro.idTipPar", "=", 1)->select("parametro.id as idPar")->get();

        foreach ($parametrosPorta as $parPorta) {

//el id del documento portafolio
            $idParPor = $parPorta->idPar;

            //Verifica  que el portafolio docente contengan todos los parametros del Portafolio

            $actualizarParametroPorta = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->join("tipo_parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("portafolio.id", "=", $idPor)->where("documento_portafolio.idPar", "=", $idParPor)->select("documento_portafolio.*")->get();

            if (!count($actualizarParametroPorta)) {
                $documentoPorta = new Documento_Portafolio;
                $documentoPorta->idPor = $idPor;
                $documentoPorta->idPar = $idParPor;
                $documentoPorta->descripcion = "";
                $documentoPorta->urlArchivo = "";
                $documentoPorta->tipo = "";
                $documentoPorta->save();
            }
        }

        $parametroPortafolio = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->where("documento_portafolio.idPor", "=", $idPor)->select("documento_portafolio.*", "parametro.nombre as parametro")->get();

        //dd($parametroPortafolio);

        $paralelo = DB::table('paralelo')->orderBy('nombre', 'asc')->get();
        return view("Docente.materiasPortafolio")->with("tiempoTares", $tiempoTares)->with("hoy", $hoy)->with("carreraActual", $carreraActual)->with("periodoActual", $periodoActual)->with("idPortafolioActual", $idPor)->with('paralelo', $paralelo)->with("nombrePortafolio", $portafolio->nombre)->with("parametrosPorta", $parametroPortafolio);

    }

    public function registrarCarreraCiclo($idCarCic, $idCar, $idCic)
    {
        $carrera_ciclos = new Carrera_ciclo;
        $carrera_ciclos->id = $idCarCic;
        $carrera_ciclos->idCar = $idCar;
        $carrera_ciclos->idCic = $idCic;
        $carrera_ciclos->save();

    }

    public function cargarMateria($idCic, $idCar)
    {
        $materia = Materia::all();
//REGISTRAR MATERIA CORRESPONDIENTES A CADA CARRERA Y CICLO
        if (!count($materia)) {
//MATERIAS PARA INGENIERIA EN SISTEMA CODIGO 4 SISTEMA
            //Upload Materias Electrica
            $this->registrarCarreraCiclo(11, 1, 1);
//upload materias
            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "ANALISIS MATEMATICO I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "ANALISIS SOCIOECONOMICO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "GEOMETRIA PLANA Y ANALITICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "METODOLOGIA DE LA INVESTIGACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "QUIMICA GENERAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "FISICA I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 11;
            $materias->nombre = "COMPUTACION BASICA";
            $materias->save();

            $this->registrarCarreraCiclo(12, 1, 2);

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "ALGORITMOS Y LENGUAJES DE P.";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "FISICA II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "DISEÑO DE PROYECTOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "ANALISIS MATEMATICO II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "PROBLEMAS DEL MUNDO CONTEMPORANEO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "CIRCUITOS ELECTRICOS I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 12;
            $materias->nombre = "ESTADISTICA";
            $materias->save();

            $this->registrarCarreraCiclo(13, 1, 3);

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "ANALISIS VECTORIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "TEORIA ELECTROMAGNETICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "DESARROLLO LOCAL Y EXTENSION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "CIRCUITOS ELECTRICOS II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "ELECTRONICA I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "ANALISIS MATEMATICO III";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 13;
            $materias->nombre = "PROGRAMACION";
            $materias->save();

            $this->registrarCarreraCiclo(14, 1, 4);
            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "CONTABILIDAD GENERAL Y COSTOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "IDENTIDAD CULTURAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "MAQUINAS ELECTRICAS I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "SISTEMAS DIGITALES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "INSTRUMENTOS Y EQUIPO ELETRONICO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 14;
            $materias->nombre = "ELECTRONICA II";
            $materias->save();

            $this->registrarCarreraCiclo(15, 1, 5);
            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "CONTROL INDUSTRIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "EQUIDAD Y GENERO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "INSTALACIONES ELECTRICAS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "SISTEMAS DE CONTROL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "MAQUINAS ELECTRICAS II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 15;
            $materias->nombre = "INGENIERIA ECONOMICA";
            $materias->save();

            $this->registrarCarreraCiclo(16, 1, 6);

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "ELECTRONICA DE POTENCIA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "DISTRIBUCION I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "ALTO VOLTAJE";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "EDUCACION AMBIENTAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "SISTEMAS ELECTRICOS DE POTENCIA I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "PROYECTO INTEGRADOR I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "ELECTRONICA DE POTENCIA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 16;
            $materias->nombre = "CENTRALES DE GENERACION";
            $materias->save();

            $this->registrarCarreraCiclo(17, 1, 7);

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "DISEÑO EN ALTO VOLTAJE";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "PROTECCIONES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "CALIDAD DE ENERGIA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "INSTALACIONES INDUSTRIALES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "MATLAB Y SIMUKINK";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "DISTRIBUCIÓN II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 17;
            $materias->nombre = "SISTEMAS ELECTRICOS DE POTENCIA II";
            $materias->save();

            $this->registrarCarreraCiclo(18, 1, 8);

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "PLANIFICACION SEP";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "CONSTRUCCION DE REDES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "CONFIABILIDAD DE SEP";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "OPERACION SEP";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "PROYECTO INTEGRADOR II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "AUTOCAD";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "ADMINISTRACIÓN DE PROYECTOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 18;
            $materias->nombre = "DINÁMICA DE MAQUINAS";
            $materias->save();

            $this->registrarCarreraCiclo(19, 1, 9);

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "OPERACION DE SUBESTACIONES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "LINEAS DE TRANSMISION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "TARIFAS Y MEM";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "ENERGIAS ALTERNATIVAS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "SEGURIDAD INDUSTRIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "PROYECTO DE TITULACION I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 19;
            $materias->nombre = "DOMÓTICA";
            $materias->save();

            $this->registrarCarreraCiclo(110, 1, 10);

            $materias = new Materia;
            $materias->idCarCic = 110;
            $materias->nombre = "PROYECTO DE TITULACION II";
            $materias->save();

//Upload Materias Industrial

            $this->registrarCarreraCiclo(21, 2, 1);
//upload materias
            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "FISICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "ANALISIS MATEMATICO I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "TRIGONOMETRIA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "METODOLOGIA DE LA INVESTIGACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "COMPUTACION BASICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "ANALISIS SOCIECONOMICO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 21;
            $materias->nombre = "GEOMETRIA PLANA Y ANALITICA";
            $materias->save();

            $this->registrarCarreraCiclo(22, 2, 2);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "QUIMICA INDUSTRIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "FISICA II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "DISEÑO DE PROYECTOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "ESTADISTICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "PRO. DEL MUNDO CONTENPORANEO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "QUIMICA INDUSTRIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "CAD";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 22;
            $materias->nombre = "ANALISIS MATEMATICO II";
            $materias->save();

            $this->registrarCarreraCiclo(23, 2, 3);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "ANALISIS MATEMATICO III";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "ESTATICA Y DINAMICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "ERGONOMIA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "CONTABILIDAD GENERAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "CIRCUITOS ELECTRICOS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "TALLER MECANICO I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 23;
            $materias->nombre = "DESARROLLO LOCAL Y EXTENSION";
            $materias->save();

            $this->registrarCarreraCiclo(24, 2, 4);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "CONTABILIDAD COSTOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "IDENTIDAD CULTURAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "ORGANIZACION INDUSTRIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "TERMODINAMICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "MAQUINAS ELECTRICAS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 24;
            $materias->nombre = "TALLER MECANICO II";
            $materias->save();

            $this->registrarCarreraCiclo(25, 2, 5);
//upload materias
            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "EQUIDAD Y GENERO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "MECANICA DE FLUIDOS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "INVESTIGACION DE OPERACIONES I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "CALIDAD";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "TRANSFERENCIA DE CALOR";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 25;
            $materias->nombre = "SEGURIDAD E HIGIENE INDUSTRIAL";
            $materias->save();

            $this->registrarCarreraCiclo(26, 2, 6);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 26;
            $materias->nombre = "EDUCACION AMBIENTAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 26;
            $materias->nombre = "SISTEMAS DE GESTION INTEGRAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 26;
            $materias->nombre = "RESISTENCIA DE MATERIALES";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 26;
            $materias->nombre = "MAQUINAS MOTRICES Y TERMICAS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 26;
            $materias->nombre = "INVESTIGACION DE OPERACIONES II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 26;
            $materias->nombre = "PROYECTO INTEGRADOR I";
            $materias->save();

            $this->registrarCarreraCiclo(27, 2, 7);
//upload materias
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "GESTION DEL TALENTO HUMANO";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "SEGURIDAD Y SALUD OCUPACIONAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "INGENIERIA DE MANTENIMIENTO";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "ADMINISTRACION DE LA PRODUCCION I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "INGENIERIA ECONOMICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "PSICOLOGIA INDUSTRIAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "INSTRUMENTACION INDUSTRIAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 27;
            $materias->nombre = "CONTROL INDUSTRIAL ";
            $materias->save();

            $this->registrarCarreraCiclo(28, 2, 8);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "INGENIERIA AMBIENTAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "INGENIERIA FINANCIERA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "INGENIERIA DE METODOS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "ADMINISTRACION DE LA PRODUCCION II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "PRODUCCION";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "PROYECTO INTEGRADOR II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "DERECHO LABORAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 28;
            $materias->nombre = "PROGRAMADORES LÓGICOS PLC's";
            $materias->save();

            $this->registrarCarreraCiclo(29, 2, 9);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 29;
            $materias->nombre = "ADMINISTRACION EMPRESARIAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 29;
            $materias->nombre = "MARKETING Y VENTAS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 29;
            $materias->nombre = "LOCALIZACION Y DISEÑO DE PLANTAS INDUSTRIALES";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 29;
            $materias->nombre = "ELABORACION Y EVALUACION DE PROYECTOS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 29;
            $materias->nombre = "TITULACIÓN I ";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 29;
            $materias->nombre = "SART";
            $materias->save();
            $this->registrarCarreraCiclo(210, 2, 10);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 210;
            $materias->nombre = "TITULACION II";
            $materias->save();

//Upload Materias Electromecanica

            $this->registrarCarreraCiclo(31, 3, 1);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "FISICA I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "GEOMETRIA ANALITICA Y PLANA ";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "COMPUTACIO BASICA ";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "ANALISIS MATEMATICO I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "QUIMICA GENERAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "METODOLOGIA DE LA INVESTIGACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 31;
            $materias->nombre = "ANALISIS SOCIOECONOMICO";
            $materias->save();
            $this->registrarCarreraCiclo(32, 3, 2);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "FISICA II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "DISEÑO DE PROYECTOS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "PROGRAMACION";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "ESTADISTICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "DIBUJO TECNICO";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "ANALISIS MATEMATICO II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 32;
            $materias->nombre = "PROBLEMAS DEL MUNDO CONTEMP";
            $materias->save();
            $this->registrarCarreraCiclo(33, 3, 3);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "CIRCUITOS ELECTRICOS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "ANALSIS MATEMATICO III";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "DIBUJO ASISTIDO POR COMPUTADOR";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "DESARROLLO LOCAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "TALLER MECANICO I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "TEORIA ELECTROMAGNETICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 33;
            $materias->nombre = "CONTABILIDAD GENERAL Y COSTOS";
            $materias->save();
            $this->registrarCarreraCiclo(34, 3, 4);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "MAQUINAS ELECTRICAS I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "TALLER MECANICO II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "RESISTENCIA DE MATERIALES";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "ELECTRONICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "SISTEMAS DIGITALES";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL I";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 34;
            $materias->nombre = "IDENTIDAD CULTURAL";
            $materias->save();

            $this->registrarCarreraCiclo(35, 3, 5);
//upload materias
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "MAQUINAS ELECTRICAS II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "DINAMICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "TERMODINAMICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "ESTATICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL II";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "ELECTRONICA DE POTENCIA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 35;
            $materias->nombre = "EQUIDAD DE GENERO";
            $materias->save();

            $this->registrarCarreraCiclo(36, 3, 6);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "EDUCACION AMBIENTAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "MECANISMOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "FLUIDOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "PROYECTO INTEGRADOR I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "INSTALACIONES ELECTRICAS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "TERMOAPLICADA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 36;
            $materias->nombre = "CONTROL INDUSTRAL";
            $materias->save();

            $this->registrarCarreraCiclo(37, 3, 7);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "CONTROL HIDRONEUMATICO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "MAQUINAS MOTRICES Y TERMICAS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "CONTROL DE AUTOMATAS PROGRAMABLES";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "ROBOTICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "DISEÑO DE ELEMENTOS DE MAQUINAS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "EQUIPO Y DISTRIBUCION ELECTRICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "SISTEMAS DE CONTROL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 37;
            $materias->nombre = "LINEAS DE TRASMISION";
            $materias->save();

            $this->registrarCarreraCiclo(38, 3, 8);
//upload materias
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "SEGURIDAD INDUSTRIAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "MEDIDAS ELECTRICAS E INSTRUMENTACION";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "REFRIGERACION Y AIRE ACONDICIONADO";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "GESTION DE CALIDAD Y PRODUCCION";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "PROTECCIONES ELECTRICAS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "CAD/CAM";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 38;
            $materias->nombre = "PROYECTO INTEGRADOR II";
            $materias->save();
            $materias->idCarCic = 38;
            $materias->nombre = "SUBESTACIONES Y CENTRALES ELECTRICAS";
            $materias->save();
            $this->registrarCarreraCiclo(39, 3, 9);

//upload materias
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "NORMALIZACION ELECTRICA Y MECANICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "ENERGIAS RENOVABLES";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "MANTENIMIENTO INDUSTRIAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "SISTEMAS ELECTRICOS DE POTENCIA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "DISEÑO DE ANTEPROYECTO DE TESIS";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "ALTO VOLTAJE";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "LEGISLACION LABORAL";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "INGENIERÍA ECONÓMICA";
            $materias->save();
            $materias = new Materia;
            $materias->idCarCic = 39;
            $materias->nombre = "DISEÑO DE ANTEPROYECTO DE TESIS";
            $materias->save();

            $this->registrarCarreraCiclo(310, 3, 10);

            $materias = new Materia;
            $materias->idCarCic = 310;
            $materias->nombre = "DESARROLLO DE TESIS";
            $materias->save();

//Ingresar materias de primero ing Sistema
            $this->registrarCarreraCiclo(41, 4, 1);
            $materias = new Materia;
            $materias->idCarCic = 41;
            $materias->nombre = "GEOMETRIA Y TRIGONOMETRIA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 41;
            $materias->nombre = "ESTADISTICA Y PROBABILIDAD";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 41;
            $materias->nombre = "LOGICA DE PROGRAMACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 41;
            $materias->nombre = "METODOLOGIA DE LA INVESTIGACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 41;
            $materias->nombre = "ANALS. MATEMATICO I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 41;
            $materias->nombre = "COMPUTACION BASICA";
            $materias->save();

            $this->registrarCarreraCiclo(42, 4, 2);

            $materias = new Materia;
            $materias->idCarCic = 42;
            $materias->nombre = "LENGUAJE DE PROGRAMACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 42;
            $materias->nombre = "CONTABILIDAD";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 42;
            $materias->nombre = "ELECTROTECNIA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 42;
            $materias->nombre = "ANALS. MATEMATICO II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 42;
            $materias->nombre = "PROBLEMAS DEL MUNDO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 42;
            $materias->nombre = "DISEÑO DE PROYECTOS";
            $materias->save();
            $this->registrarCarreraCiclo(43, 4, 3);

            $materias = new Materia;
            $materias->idCarCic = 43;
            $materias->nombre = "CONTABILIDAD DE COSTOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 43;
            $materias->nombre = "PROGRAMACION ESTRUCTURADA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 43;
            $materias->nombre = "SISTEMAS DIGITALES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 43;
            $materias->nombre = "DESARROLLO LOCAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 43;
            $materias->nombre = "INT. A LAS BASES DE DATOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 43;
            $materias->nombre = "METODOS NUMERICOS";
            $materias->save();

            $this->registrarCarreraCiclo(44, 4, 4);

            $materias = new Materia;
            $materias->idCarCic = 44;
            $materias->nombre = "IDENTIDAD CULTURAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 44;
            $materias->nombre = "PROG. ORIENT. OBJETOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 44;
            $materias->nombre = "MATEMÁTICAS DISCRETAS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 44;
            $materias->nombre = "ARQUITECTURA DE COMPUTADORES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 44;
            $materias->nombre = "ESTRUCTURA DE DATOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 44;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL I";
            $materias->save();

            $this->registrarCarreraCiclo(45, 4, 5);

            $materias = new Materia;
            $materias->idCarCic = 45;
            $materias->nombre = "SISTEMAS DE COMUNICACIÓN";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 45;
            $materias->nombre = "PROG. BASE DE DATOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 45;
            $materias->nombre = "EQUIDAD Y GENERO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 45;
            $materias->nombre = "EMPRENDIMIENTO SOCIAL II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 45;
            $materias->nombre = "MANTENIMIENTO DEL COMPUTADOR";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 45;
            $materias->nombre = "INTEF. GRAFICA DE USUARIO";
            $materias->save();

            $this->registrarCarreraCiclo(46, 4, 6);
            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "PROYECTO INTEGRADOR I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "ANL.Y DIS. ORIENTADO A OBJETO";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "EDUCACION AMBIENTAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "APLIC. BASE DE DATOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "REDES I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "DESARROLLO WEB";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 46;
            $materias->nombre = "PROGRAMACION MULTIMEDIA";
            $materias->save();

            $this->registrarCarreraCiclo(47, 4, 7);
            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "ADM.DE BASES DE DATOS ORACLE";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "APLICACIONES WEB";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "INGENIERIA DE SOFTWARE I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "LIDERAZGO Y MOTIVACION";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "NTICS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "REDES II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 47;
            $materias->nombre = "SISTEMAS OPERATIVOS";
            $materias->save();

            $this->registrarCarreraCiclo(48, 4, 8);
            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "ADM. EMPRESARIAL Y DE PERSONAL";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "SISTEMAS DISTRIBUIDOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = " DISENO PROYECTOS INFORMATICOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "APP. DE SISTEMAS OPERATIVOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "PROYECTO INTEGRADOR II";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "PROGRAMACION DE DISPOSITIVOS";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "INGENIERIA DE USABILIDAD";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 48;
            $materias->nombre = "INGENIERIA DE SOFTWARE II";
            $materias->save();

            $this->registrarCarreraCiclo(49, 4, 9);

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "ADM. Y AUDITORIA INFORMATICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "PROYECTO DE TITULACION I";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "DESARROLLO DE APLICACIONES MOVILES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "TOPICOS ESPECIALES";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "SISTEMAS CAD/CAM";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "SEGURIDAD INFORMATICA";
            $materias->save();

            $materias = new Materia;
            $materias->idCarCic = 49;
            $materias->nombre = "INTELIGENCIA ARTIFICIAL";
            $materias->save();

            $this->registrarCarreraCiclo(410, 4, 10);
            $materias = new Materia;
            $materias->idCarCic = 410;
            $materias->nombre = "PROYECTO DE TITULACION II";
            $materias->save();

        }

//cONSULTAR MATERIA

        $consultarMateria = DB::table("carrera")->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")->where("carrera_ciclo.idCar", "=", $idCar)->where("carrera_ciclo.idCic", "=", $idCic)->select("materia.*")->get();

        return view("Docente.cargar_materia")->with("materias", $consultarMateria);
    }

    public function agregarMateriaPortafolio(Request $request)
    {
//Id Portafolio
        $portafolio = $request->input("portafolio");
//id Materia
        $materia = $request->input("materia");

        $paralelo = $request->input('paralelo');

        $verificaAsignaturaPorta = DB::table('portafolio_materia')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->where('portafolio_materia.idMat', '=', $materia)->where('portafolio_materia.idPor', '=', $portafolio)->where('portafolio_materia.idPar', '=', $paralelo)->select('portafolio_materia.*')->get();

        if (!count($verificaAsignaturaPorta)) {
            $consultarmate = Materia::find($materia);
//Campo nombre de la materia
            $idMat = $consultarmate->id;
            $nombreMat = $consultarmate->nombre;
//REgistrar materia para el guardado para proceder al guardado portafolio
            $portafolio_materia = new Portafolio_Materia;
            $portafolio_materia->idPor = $portafolio;
            $portafolio_materia->idPar = $paralelo;
            $portafolio_materia->idMat = $idMat;
            $portafolio_materia->nombreMateria = $nombreMat;
            $portafolio_materia->save();

//Consulatar las materias regustradas en el poratafolio academico docente
            //$materiasCreadasPortafolio=Portafolio_Materia::find($portafolio);

            return view("mensajes.msj_correcto")->with("msj", "Asignatura registrada correctamente en el portafolio Docente.");

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Asignatura ya registrada en el Portafolio Docente.");
        }
    }

    public function materiaRegistradaPortafolio($idPor)
    {

        $materiasCreadasPortafolio = DB::table("portafolio")->join("portafolio_materia", "portafolio.id", "=", "portafolio_materia.idPor")->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where("portafolio_materia.idPor", "=", $idPor)->select('portafolio_materia.*', 'portafolio_materia.id as idMatPor', 'ciclo.nombre as ciclo', 'ciclo.id', 'paralelo.nombre as paralelo')->orderBy('ciclo.id', 'asc')->orderBy('paralelo', 'asc')->get();

        if (count($materiasCreadasPortafolio)) {
            return view("Docente.icon_materia_portafolio_existentes")->with("materiaRegistradaPortafolio", $materiasCreadasPortafolio);
        } else {
            echo "<div class='alert alert-warning'>
        <strong>No existen Asignaturas</strong> registradas en el portafolio Docente.. </div> ";

        }

    }

    public function parametrosAsignatura($idPorMat)
    {
        $portafolio_materia = Portafolio_Materia::find($idPorMat);

        //Nombre del periodo actual segun el id portafolio
        $periodoActual = DB::table("periodo")->join("portafolio", "periodo.id", "=", "portafolio.idPer")->where("portafolio.id", "=", $portafolio_materia->idPor)->select("periodo.*")->first();
        // para consultar el tiempo de subida de tarea
        $tiempoTares = TareaPortafolio::find($periodoActual->id);

//dd("Codigo materia Portafolio".$idMatPor)
        //Consultar todos los parametro para  registrarles con la materia correspondiente
        // $parametros = Parametro::all();

        //dd($parametros);

        //Consulta los parametros que pertenece a las materias
        $parametrosMate = DB::table("tipo_parametro")->join("parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("parametro.idTipPar", "=", 2)->select("parametro.id as idPar")->get();
        //dd($parametrosMate);

        foreach ($parametrosMate as $parMat) {

//id del parametro
            $idParMat = $parMat->idPar;
            //Verifica  que la materia seleccionada conste con todos los parametros  se actualizan automaticamente los parametros de la Asignatura
            $actualizarParametroMate = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->join("tipo_parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("documento_materia.idPar", "=", $idParMat)->select("documento_materia.*")->get();

            if (!count($actualizarParametroMate)) {
                $documentoMat = new Documento_Materia;
                $documentoMat->idPorMat = $idPorMat;
                $documentoMat->idPar = $idParMat;
                $documentoMat->descripcion = "";
                $documentoMat->urlArchivo = "";
                $documentoMat->tipo = "";
                $documentoMat->save();
            }
        }

//Consultar todos los paramtros que poseen las Asignatura

        $parametroMateria = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->select("documento_materia.*", "parametro.nombre")->get();

        //dd($parametroMateria);

        // dd($actualizarParametroMate);

        //El parametro tipo 3 que es solo parametros productos
        $parametrosProd = DB::table("tipo_parametro")->join("parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("parametro.idTipPar", "=", 3)->select("parametro.id as idPara")->get();

        $productosAca = Producto_Academico::all();

        //Asignar a los cuatro Productos

        foreach ($productosAca as $prodAca) {

            $idProdAca = $prodAca->id;

            // dd($idProdAca);
            foreach ($parametrosProd as $par) {

//id del parametro
                $idPar = $par->idPara;
                //Verifica  que todos los productos tenga todos los parametros  se actualizan automaticamente los parametros
                $actualizarParametro = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->join("tipo_parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->join("producto_academico", "producto_academico.id", "=", "documento.idProAca")->where("documento.idPar", "=", $idPar)->where("documento.idProAca", "=", $idProdAca)->select("documento.*")->get();

                if (!count($actualizarParametro)) {
                    $documento = new Documento;
                    $documento->idPorMat = $idPorMat;
                    $documento->idPar = $idPar;
                    $documento->idProAca = $prodAca->id;
                    $documento->descripcion = "";
                    $documento->urlArchivo = "";
                    $documento->tipo = "";
                    $documento->save();
                }
            }

        }

//Consultar todos los paramtros que poseen los productos

        $parametroProducto = DB::table("portafolio_materia")->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")->join("parametro", "parametro.id", "=", "documento.idPar")->where("documento.idPorMat", "=", $idPorMat)->select("documento.*", "parametro.nombre")->get();

//Para el membrete

        $materiasCreadas = DB::table('portafolio')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where('portafolio_materia.id', '=', $idPorMat)->select('portafolio_materia.idPor as idPortafolio', 'portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia')->first();

//Tambien ontenemos el id del portafolio

//Obtener el idPortafolio

        // dd($materiasCreadas->idPortafolio);
        //Para obtener el periodo y carrera del portafolio

        $portaDatos = DB::table("portafolio")->join("carrera", "carrera.id", "=", "portafolio.idCar")->join("periodo", "periodo.id", "=", "portafolio.idPer")->where("portafolio.id", "=", $materiasCreadas->idPortafolio)->select("periodo.desde as desde", "periodo.hasta as hasta", "carrera.nombre as carrera")->first();

        //  dd($portaDatos->desde . "-" . $portaDatos->hasta . "-" . $portaDatos->carrera);

        //fecha y hora del servidor
        $hoy = Carbon::now();

        //tiempo de eliminacion de los documentos

        if (count($parametroProducto)) {
            return view("Docente.parametrosAsignatura")
                ->with("idPorMat", $idPorMat)
                ->with("parametrosProducto", $parametroProducto)
                ->with("parametrosMateria", $parametroMateria)
                ->with("membrete", $materiasCreadas)
                ->with("portafolio", $portaDatos)
                ->with("productosAll", $productosAca)
                ->with("tiempoTares", $tiempoTares)
                ->with("hoy", $hoy);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existen ningun parámetro registrado :");
        }
    }

    public function actualizarParametro($idPorMat)
    {

        $portafolio_materia = Portafolio_Materia::find($idPorMat);
        //Nombre del periodo actual segun el id portafolio
        $periodoActual = DB::table("periodo")->join("portafolio", "periodo.id", "=", "portafolio.idPer")
            ->where("portafolio.id", "=", $portafolio_materia->idPor)
            ->select("periodo.*")->first();
        // para consultar el tiempo de subida de tarea
        $tiempoTares = TareaPortafolio::find($periodoActual->id);


        //fecha y hora del servidor
        $hoy = Carbon::now();
        //dd("Codigo materia Portafolio".$idMatPor)
        //Consultar todos los parametro para  registrarles con la materia correspondiente
        // $parametros = Parametro::all();

        //dd($parametros);

        //Consulta los parametros que pertenece a las materias
        $parametrosMate = DB::table("tipo_parametro")->join("parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("parametro.idTipPar", "=", 2)->select("parametro.id as idPara")->get();
        //dd($parametrosMate);

        foreach ($parametrosMate as $parMat) {

//id del parametro
            $idParMat = $parMat->idPara;
            //Verifica  que la materia seleccionada conste con todos los parametros  se actualizan automaticamente los parametros de la Asignatura
            $actualizarParametroMate = DB::table("portafolio_materia")->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")->join("parametro", "parametro.id", "=", "documento_materia.idPar")->where("documento_materia.idPorMat", "=", $idPorMat)->join("tipo_parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("documento_materia.idPar", "=", $idParMat)->select("documento_materia.*")->get();

            if (!count($actualizarParametroMate)) {
                $documentoMat = new Documento_Materia;
                $documentoMat->idPorMat = $idPorMat;
                $documentoMat->idPar = $idParMat;
                $documentoMat->descripcion = "";
                $documentoMat->urlArchivo = "";
                $documentoMat->tipo = "";
                $documentoMat->save();
            }
        }

//Consultar todos los paramtros que poseen las Asignatura

        $parametroMateria = DB::table("portafolio_materia")
            ->join("documento_materia", "portafolio_materia.id", "=", "documento_materia.idPorMat")
            ->join("parametro", "parametro.id", "=", "documento_materia.idPar")
            ->where("documento_materia.idPorMat", "=", $idPorMat)
            ->select("documento_materia.*", "parametro.nombre")
            ->get();

        //dd($parametroMateria);

        // dd($actualizarParametroMate);

        //El parametro tipo 3 que es solo parametros productos
        $parametrosProd = DB::table("tipo_parametro")
            ->join("parametro", "tipo_parametro.id", "=", "parametro.idTipPar")
            ->where("parametro.idTipPar", "=", 3)
            ->select("parametro.id as idPar")
            ->get();

        $productosAca = Producto_Academico::all();

        //Asignar a los cuatro Productos

        foreach ($productosAca as $prodAca) {

            $idProdAca = $prodAca->id;

            // dd($idProdAca);
            foreach ($parametrosProd as $par) {

//id del parametro
                $idPar = $par->idPar;
                //Verifica  que todos los productos tenga todos los parametros  se actualizan automaticamente los parametros
                $actualizarParametro = DB::table("portafolio_materia")
                    ->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")
                    ->join("parametro", "parametro.id", "=", "documento.idPar")
                    ->where("documento.idPorMat", "=", $idPorMat)
                    ->join("tipo_parametro", "tipo_parametro.id", "=", "parametro.idTipPar")
                    ->join("producto_academico", "producto_academico.id", "=", "documento.idProAca")
                    ->where("documento.idPar", "=", $idPar)
                    ->where("documento.idProAca", "=", $idProdAca)
                    ->select("documento.*")
                    ->get();

                if (!count($actualizarParametro)) {
                    $documento = new Documento;
                    $documento->idPorMat = $idPorMat;
                    $documento->idPar = $idPar;
                    $documento->idProAca = $prodAca->id;
                    $documento->descripcion = "";
                    $documento->urlArchivo = "";
                    $documento->tipo = "";
                    $documento->save();
                }
            }

        }

//Consultar todos los paramtros que poseen los productos

        $parametroProducto = DB::table("portafolio_materia")
            ->join("documento", "portafolio_materia.id", "=", "documento.idPorMat")
            ->join("parametro", "parametro.id", "=", "documento.idPar")
            ->where("documento.idPorMat", "=", $idPorMat)
            ->select("documento.*", "parametro.nombre")->get();

//Para el membrete

        $materiasCreadas = DB::table('portafolio')
            ->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')
            ->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')
            ->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')
            ->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')
            ->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')
            ->where('portafolio_materia.id', '=', $idPorMat)
            ->select('portafolio_materia.idPor as idPortafolio', 'portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia')
            ->first();

//Tambien ontenemos el id del portafolio

//Obtener el idPortafolio

        // dd($materiasCreadas->idPortafolio);
        //Para obtener el periodo y carrera del portafolio

        $portaDatos = DB::table("portafolio")
            ->join("carrera", "carrera.id", "=", "portafolio.idCar")
            ->join("periodo", "periodo.id", "=", "portafolio.idPer")
            ->where("portafolio.id", "=", $materiasCreadas->idPortafolio)
            ->select("periodo.desde as desde", "periodo.hasta as hasta", "carrera.nombre as carrera")
            ->first();

        //  dd($portaDatos->desde . "-" . $portaDatos->hasta . "-" . $portaDatos->carrera);

        if (count($parametroProducto)) {
            return view("Docente.actualizarParametro")
                ->with("idPorMat", $idPorMat)
                ->with("parametrosProducto", $parametroProducto)
                ->with("parametrosMateria", $parametroMateria)
                ->with("membrete", $materiasCreadas)
                ->with("portafolio", $portaDatos)
                ->with("productosAll", $productosAca)
                ->with("tiempoTares", $tiempoTares)
                ->with("hoy", $hoy);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existen ningun parámetro:");
        }

    }

    public function reporteCumplimiento($idPor)
    {

//Para el membrete
        $portafolio = DB::table('portafolio')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->join('carrera', 'carrera.id', '=', 'portafolio.idCar')->join('users', 'users.id', '=', 'portafolio.idDoc')->where('portafolio.id', '=', $idPor)->select('periodo.*', 'portafolio.id as idPorta', 'portafolio.nombre as portafolio', 'carrera.nombre as carrera', 'users.nombre as nombreDoc', 'users.apellido as apellidoDoc')->first();

//$materiasCreadasPortafolio=DB::table("portafolio")->join("portafolio_materia","portafolio.id","=","portafolio_materia.idPor")->join('paralelo','paralelo.id','=','portafolio_materia.idPar')->join('materia','materia.id','=','portafolio_materia.idMat')->join('carrera_ciclo','carrera_ciclo.id','=','materia.idCarCic')->join('ciclo','ciclo.id','=','carrera_ciclo.idCic')->where("portafolio_materia.idPor","=",$idPor)->select('portafolio_materia.*', 'portafolio_materia.id as idMatPor','paralelo.nombre as paralelo','ciclo.nombre as ciclo','ciclo.id')->orderBy('ciclo.id','asc')->get();
        //Para las asignatura ciclo y paralelo

        //Parametros Portafolio

        $parametroPortafolio = DB::table("portafolio")->join("documento_portafolio", "portafolio.id", "=", "documento_portafolio.idPor")->join("parametro", "parametro.id", "=", "documento_portafolio.idPar")->join("tipo_parametro", "tipo_parametro.id", "=", "parametro.idTipPar")->where("documento_portafolio.idPor", "=", $idPor)->select("documento_portafolio.*", "parametro.nombre as parametro")->get();

        $materiasCreadas = DB::table('portafolio')->join('portafolio_materia', 'portafolio.id', '=', 'portafolio_materia.idPor')->join('paralelo', 'paralelo.id', '=', 'portafolio_materia.idPar')->join('materia', 'materia.id', '=', 'portafolio_materia.idMat')->join('carrera_ciclo', 'carrera_ciclo.id', '=', 'materia.idCarCic')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')->where('portafolio.id', '=', $idPor)->select('portafolio_materia.id as idPorMat', 'ciclo.nombre as ciclo', 'paralelo.nombre as paralelo', 'materia.nombre as materia', 'ciclo.id', 'paralelo.id as paralelos')->orderBy('ciclo.id', 'asc')->orderBy('paralelos', 'asc')->get();

        return view('Coordinador.reporteCumplimiento')->with('portafolio', $portafolio)->with('materias', $materiasCreadas)->with("parametroPortafolio", $parametroPortafolio);

    }

    public function reportes()
    {
        // $parametros = Ciclo::all();
        // return view('Coordinador.reportes')->with('parametro', $parametros);
    }


}
