<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Carrera_Ciclo;
use App\Ciclo;
use App\Documento;
use App\Materia;
use App\Parametro;
use App\Periodo;
use App\Portafolio;
use App\Portafolio_Materia;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PeriodosController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');

	}


	public function index()
{

	return view("Decano.agregarperiodoDecano");

}


public function periodoRegistradoPortafolio()
{

	$periodo = Periodo::all();
	return view("Decano.formularioperiodoDecano")->with("periodo", $periodo);

}

public function crearPeriodo(Request $request)
	{
//User es un metodo declarado para obtener todos los campos del docente logueado



		$desde = $request->input("desdePeriodo");
		$hasta = $request->input("hastaPeriodo");

		$verificaperiodo = DB::table('periodo')->where('periodo.desde','=',$desde)->select('periodo.desde')->get();


		if (!count($verificaperiodo)) {
			$periodo = new Periodo;
			$periodo->desde = $request->input("desdePeriodo");
			$periodo->hasta = $request->input("hastaPeriodo");
			$periodo->save();
			echo "<div class='alert alert-info'>
			<strong>Periodo </strong>registrado correctamente en el portafolio Docente..
		</div>";


	}else{
		echo "<div class='alert alert-danger'>
		<strong>Periodo</strong> ya registrado en el portafolio Docente.. </div> ";



	}

	$periodo = Periodo::all();
	return view("Decano.formularioperiodoDecano")->with("periodo", $periodo);


}



}
