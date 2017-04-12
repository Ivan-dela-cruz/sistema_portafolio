<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titulo;
use App\Nivel;
use App\User;

use App\Http\Controllers\Controller;


class TitulosController extends Controller
{

public function __construct(){
$this->middleware('auth');

}



public function consultarEstudiosDoc($id){
$docente=User::find($id);
$nivels=Nivel::all();
//$cont=count($docente);

if (!count($nivels)) {
	$nivels= new Nivel;
	$nivels->id=1;
	$nivels->nombre="TERCER";
	$nivels->save();



	$nivels= new Nivel;
	$nivels->id=2;
	$nivels->nombre="CUARTO";
	$nivels->save();
	
}

$nivel=Nivel::all();
//El metodo titulos se encuentra en el modelo User
$titulo=$docente->titulos();
//dd($titulo);
return view("Docente.estudios")->with("docente",$docente)->with("nivel",$nivel)->with("titulo",$titulo);
}




public function agregarTitulo(Request $request){
$titulo= new titulo;
$titulo->idDoc=$request->input("idDoc");
$titulo->idNivel=$request->input("nivel");
$titulo->nombre=$request->input("titulo");
$titulo->fechaRegistro=$request->input("fecha");
$titulo->codigoRegistro=$request->input("codigoSnt");
$rs=$titulo->save();
if($rs)
return view("mensajes.msj_correcto")->with("msj","Título registrado correctamente. ");
else
return view("mensajes.msj_rechazado")->with("msj","Huvo un error intente nuevamente.");
}



public function eliminarTitulo($id){
$titulo=Titulo::find($id);
$rs=$titulo->delete();
if ($rs) 
	return view("mensajes.msj_correcto")->with("msj","Título borrado Correctamente ");
else{
return view("mensajes.msj_rechazado")->with("msj","Huvo un error vuelva a intentar ");

}

}




}
