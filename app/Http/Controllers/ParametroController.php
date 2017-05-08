<?php

namespace App\Http\Controllers;


use App\Carrera;
use App\Carrera_Ciclo;
use App\Ciclo;
use App\Documento;
use App\Materia;
use App\Parametro;
use App\Portafolio;
use App\Portafolio_Materia;
use App\User;
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



		$comparar = $request->input("nombreParametro");

		$verificaAsignaturaPorta = DB::table('parametro')->where('parametro.nombre','=',$comparar)->select('parametro.nombre')->get();


		if (!count($verificaAsignaturaPorta)) {
			$parametro = new Parametro;
			$parametro->nombre = $request->input("nombreParametro");
			$parametro->save();
			echo "<div class='alert alert-info'>
			<strong>Parametro </strong>registrado correctamente en el portafolio Docente..
		</div>";


	}else{
		echo "<div class='alert alert-danger'>
		<strong>Parametro</strong> ya registrado en el portafolio Docente.. </div> ";



	}

	$parametro = Parametro::all();
	return view("Decano.gestionDecano")->with("parametro", $parametro);


}

public function consultarParametro()
{

	return view("Decano.parametrosDecano");

}

public function parametroRegistradaPortafolio()
{

	$parametro = Parametro::all();
	return view("Decano.gestionDecano")->with("parametro", $parametro);

}

		public function delete($id)
		{

			$parametro = Parametro::find($id);
			$parametro->delete();

		if ($parametro) {

			echo "<div class='alert alert-info'>
			<strong>Parametro </strong>eliminado correctamente en el portafolio Docente..
		</div>";


		}else{
			echo "<div class='alert alert-danger'>
			<strong>Parametro</strong>no eliminado en el portafolio Docente.. </div> ";
		}
		$parametro = Parametro::all();

		return view("Decano.gestionDecano")->with("parametro", $parametro);


		}

 		public function update(Request $request,$id)
        {
        	$comparar = $id;


		$name = $request->input("descripcion") ;

        $repiteparametro = DB::select('select * from parametro where nombre = ?',[$name]) ;
        //dd($repiteparametro);



		if (!count($repiteparametro)) {
			DB::update('update parametro set nombre = ? where id = ?',[$name,$id]) ;

			echo "<div class='alert alert-info'>
			<strong>Parametro </strong>actualizado correctamente en el portafolio Docente..
		</div>";


	}else{
		echo "<div class='alert alert-danger'>
		<strong>Parametro</strong> ya se encuentra registrado.. </div> ";

	}

        $parametro = Parametro::all();

		return view("Decano.gestionDecano")->with("parametro", $parametro);


        }

}
