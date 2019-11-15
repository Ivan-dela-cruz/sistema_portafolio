<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Carrera_Ciclo;
use App\Ciclo;
use App\Materia;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ->paginate(8)\Illuminate\Http\Response
     */
    public function index()
    {
        $carrera = Carrera::all();
        $materias = DB::table("carrera")->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
            ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
            ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
            ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
            ;

        return view("Docente.RegistrarMateriasPortafolio")->with("carrera", $carrera)->with("materias", $materias);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $selecCiclo = $request->selecCiclo;
        $selecCarrera = $request->selecCarrera;
        $idUsuarioActual = \Auth::user()->id;
        //Verifica Si existe carrera
        $verificaCarrera = Carrera::all();


        if (!count($verificaCarrera)) {
            $this->registrarCarrera(1, "Ingeniería Eléctrica");
            $this->registrarCarrera(2, "Ingeniería Industrial");
            $this->registrarCarrera(3, "Ingeniería en Electromecánica");
            $this->registrarCarrera(4, "Ingeniería en Informática y Sistemas Computacionales");
        }

        $carrera = Carrera::all();
        $ciclos = Ciclo::all();

        if ($selecCarrera != 'CARRERA') {
            if ($selecCiclo != 'CICLO') {
                $materias = DB::table("carrera")
                    ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                    ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                    ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                    ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                    ->where('carrera.id', 'like', '%' . $selecCarrera . '%')
                    ->where('carrera_ciclo.idCic', 'like', '%' . $selecCiclo . '%')
                    ->paginate(12);
            } else {
                $materias = DB::table("carrera")
                    ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                    ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                    ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                    ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                    ->where('carrera.id', 'like', '%' . $selecCarrera . '%')
                    ->paginate(12);
                $selecCiclo = '';
            }
        } else {
            if ($selecCiclo != 'CICLO') {
                $materias = DB::table("carrera")
                    ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                    ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                    ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                    ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                    ->where('carrera_ciclo.idCic', 'like', '%' . $selecCiclo . '%')
                    ->paginate(12);
            } else {
                $materias = DB::table("carrera")
                    ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                    ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                    ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                    ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                    ->paginate(12);
                $selecCiclo = '';
            }
            $selecCarrera = '';
        }


        // $materias =  Materia::orderBy('id', 'ASC')->paginate(5);;

        $total = count($materias);
        $contador = count($idUsuarioActual);
        if ($contador) {
            return view("Docente.RegistrarMateriasPortafolio")
                ->with("carrera", $carrera)
                ->with('ciclos', $ciclos)
                ->with('total', $total)
                ->with("materias", $materias)
                ->with('selecCarrera', $selecCarrera)
                ->with('selecCiclo', $selecCiclo);

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existe registrado ningun Período Académico .");
        }


    }

    public function paginacionMateria(Request $request)
    {
        if ($request->ajax()) {


            $selecCiclo = $request->selecCiclo;
            $selecCarrera = $request->selecCarrera;


            if ($selecCarrera != 'CARRERA') {
                if ($selecCiclo != 'CICLO') {
                    $materias = DB::table("carrera")
                        ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                        ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                        ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                        ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                        ->where('carrera.id', 'like', '%' . $selecCarrera . '%')
                        ->where('carrera_ciclo.idCic', 'like', '%' . $selecCiclo . '%')
                        ->paginate(12);
                } else {
                    $materias = DB::table("carrera")
                        ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                        ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                        ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                        ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                        ->where('carrera.id', 'like', '%' . $selecCarrera . '%')
                        ->paginate(12);
                    $selecCiclo = '';
                }
            } else {
                if ($selecCiclo != 'CICLO') {
                    $materias = DB::table("carrera")
                        ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                        ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                        ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                        ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                        ->where('carrera_ciclo.idCic', 'like', '%' . $selecCiclo . '%')
                        ->paginate(12);
                } else {
                    $materias = DB::table("carrera")
                        ->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
                        ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
                        ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
                        ->select("materia.*", 'carrera.nombre as carrera', 'ciclo.nombre as ciclo')
                        ->paginate(12);
                    $selecCiclo = '';
                }
                $selecCarrera = '';
            }


            // $materias =  Materia::orderBy('id', 'ASC')->paginate(5);;

            $total = count($materias);


            return view('Docente.tablaMaterias',
                compact('materias', 'total', 'selecCiclo', 'selecCarrera'))->render();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idCarrera = $request->input('idCarrera');
        $idCiclo = $request->input('idCiclos');
        $nombre = strtoupper($request->input('nombre'));

        // $verificarExistenPortafolio = DB::table('portafolio')->join('users', 'users.id', '=', 'portafolio.idDoc')->join('carrera', 'carrera.id', '=', 'portafolio.idCar')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->where('carrera.id', '=', $idCarrera)->where('periodo.id', '=', $idPeriodo)->where('users.id', '=', $idDoc)->select('portafolio.*')->get();

        $carreraClico = DB::table('carrera_ciclo')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')
            ->join('carrera', 'carrera.id', '=', 'carrera_ciclo.idCar')
            ->where('carrera.id', '=', $idCarrera)
            ->where('ciclo.id', '=', $idCiclo)
            ->select('carrera_ciclo.id as idjoin')->get();

        // consultar que la materia ya exista en la carrera y el ciclo
        $consultarMateria = DB::table("carrera")->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
            ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
            ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
            ->where("carrera_ciclo.idCar", "=", $idCarrera)
            ->where("carrera_ciclo.idCic", "=", $idCiclo)
            ->where('materia.nombre', '=', $nombre)
            ->select("materia.*")->get();

        //validacion si la materia se encuentra ya registrada
        if (!count($consultarMateria)) {
            foreach ($carreraClico as $parMat) {

                //id del parametro
                $idParMat = $parMat->idjoin;
            }

            //  una vez validado crea la nueva materia
            $materia = new Materia;
            $materia->idCarCic = $idParMat;
            $materia->nombre = $nombre;
            $materia->save();

            return redirect()->route('crear_materia')->with('succes', 'Nueva asignatura agregada exitosamente');

        } else {
            return redirect()->route('crear_materia')->with('error', 'La asignatura ya existe');


        }
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
        $materia = DB::table("carrera")->join("carrera_ciclo", "carrera.id", "=", "carrera_ciclo.idCar")
            ->join("ciclo", "ciclo.id", "=", "carrera_ciclo.idCic")
            ->join("materia", "carrera_ciclo.id", "=", "materia.idCarCic")
            ->where('materia.id', '=', $id)
            ->select("materia.*", 'carrera.id as car', 'ciclo.id as cic')->first();

        if (count($materia)) {

            $carrera = Carrera::all();
            return view("Docente.editarMateria")->with("materia", $materia)->with('carrera', $carrera);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existe registrado ningun Período Académico .");
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateMateria(Request $request)
    {
        $id = $request->input('idMate');
        $idCarrera = $request->input('idCarrera');
        $idCiclo = $request->input('idCiclos');
        $nombre = strtoupper($request->input('nombre'));

        $carreraClico = DB::table('carrera_ciclo')->join('ciclo', 'ciclo.id', '=', 'carrera_ciclo.idCic')
            ->join('carrera', 'carrera.id', '=', 'carrera_ciclo.idCar')
            ->where('carrera.id', '=', $idCarrera)
            ->where('ciclo.id', '=', $idCiclo)
            ->select('carrera_ciclo.id as idjoin')->get();

        $idParMat = 0;
        foreach ($carreraClico as $parMat) {

            //id del parametro
            $idParMat = $parMat->idjoin;
        }
        if ($idParMat > 0) {
            $materia = Materia::find($id);
            $materia->idCarCic = $idParMat;
            $materia->nombre = $nombre;
            $materia->save();
            // return redirect()->url()->previous()->with('succes', 'Asignatura actualizada exitosamente');
            return redirect()->route('crear_materia')->with('succes', 'Asignatura actualizada exitosamente');
        } else {
            return redirect()->route('crear_materia')->with('error', 'Error al actualizar registro');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $materia = Materia::find($request->id);


            if ($materia->delete()) {
                return response()->json(['mensaje' => 'Registro eliminado satisfactoriamente']);
            } else {
                return response()->json(['mensaje' => 'Error al eliminar el registro']);
            }

        }

    }
}
