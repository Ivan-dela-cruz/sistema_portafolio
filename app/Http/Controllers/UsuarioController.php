<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Carrera;
use App\Periodo;
//El disco que se va a ocupar
use Storage;

use Illuminate\Support\Facades\DB;


//Para la validadcion de la imagen
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
   
	//public function consultarDocente($id){
	//$usuario=User::find($id);
	//$contador=count($usuario);
	
//	if ($contador)
//	return view("docente.form_editar_usuario")->with("usuario",$usuario);
//	else
//	return view("mensajes.msj_rechazado")->with("msj","El docente fue eliminado..");
//	}


public function editarPerfilDocente(){

$idUsuarioActual=\Auth::user();
$contador=count($idUsuarioActual);

	if ($contador)
	return view("Docente.editarPerfilDocente")->with("usuario",$idUsuarioActual);
	else
	return view("mensajes.msj_rechazado")->with("msj","El docente fue eliminado..");
	}




public function editarDocente(Request $request){

$dato=$request->all();

$idDoc=$dato['idDocente'];
$usuario=User::find($idDoc);
$usuario->nombre=$dato["nombre"];
$usuario->apellido=$dato["apellido"];
$usuario->cedula=$dato["cedula"];
$usuario->celular=$dato["celular"];
$usuario->telefono=$dato["telefono"];
$usuario->lugarNacimiento=$dato["lugar"];
$usuario->fechaNacimiento=$dato["fecha"];

$usuario->direccion=$dato["direccionDomi"];
$usuario->sexo=$dato["sexo"];
$usuario->nacionalidad=$dato["nacionalidad"];

$usuario->estadoCivil=$dato["estado"];
$usuario->cargaFamiliar=$dato["cargasFamiliar"];

$rs=$usuario->save();
if ($rs)
	return view("mensajes.msj_correcto")->with("msj","Datos actualizados correctamente..");
else
	return view("mensajes.msj_rechazado")->with("msj","Huvo un error vuelva a intentarlo..");
}

public function editarHistorial(Request $request){
$dato=$request->all();
$idDoc=$dato['idDoc'];
$usuario=User::find($idDoc);
$usuario->fechaIngresoUtc=$dato["ingresoUtc"];
$usuario->facultad=$dato["facultad"];
$rs=$usuario->save();
if ($rs)
	return view("mensajes.msj_correcto")->with("msj","Información actualizada correctamente..");
else
	return view("mensajes.msj_rechazado")->with("msj","Error intente nuevamente..");


}



	public function subirImagen(Request $request){
    $id=$request->input('id_usuario_foto');
	$archivo = $request->file('archivo');
    $input  = array('image' => $archivo) ;
    $reglas = array('image' => 'required|image|mimes:jpeg,jpg|max:2000');
        $validacion = Validator::make($input,  $reglas);
        if ($validacion->fails()){
          return view("mensajes.msj_rechazado")->with("msj","El archivo no es una imagen valida");
        }
        else
        {
	        $nombre_original=$archivo->getClientOriginalName();
			$extension=$archivo->getClientOriginalExtension();
		 
		    $nuevo_nombre="fotoUser-".$id.".".$extension;
		 //Nombre del disco creado en filesSytem    
		    $r1=Storage::disk('fotografia')->put($nuevo_nombre,  \File::get($archivo) );
		    $rutadelaimagen="storage/fotografia/".$nuevo_nombre;


		    
		    if ($r1){ 
 // dd($archivo);
			    $usuario=User::find($id);
			    $usuario->foto=$rutadelaimagen;
			    $r2=$usuario->save();
		        return view("mensajes.msj_correcto")->with("msj","Imagen agregada correctamente");
		    
		    }
		    else
		    {
		    	return view("mensajes.msj_rechazado")->with("msj"," Error no se cargo la imagen");
		    }


        }	

	}


public function cambiarClave(Request $request){

$id=$request->input("idUsu");
$email=$request->input("email");
$clave=$request->input("clave");
$usuario=User::find($id);
$usuario->email=$email;
$usuario->password=bcrypt($clave);
$rs=$usuario->save();
if($rs){
return view ("mensajes.msj_correcto")->with("msj","Contraseña actualizada correctamente." );
}else {
	return view("mensajes.msj_rechazado")->with("msj","Error al actualizar la contraseña ");
}

}




public  function listaDocente(){

$periodo=DB::table('periodo')->orderBy('id','desc')->get();
$carrera=Carrera::all();

return view("Coordinador.listaDocente")->with("carrera",$carrera)->with('periodos',$periodo);
}

public function buscarListadoDocente($idPer, $idCar, $dato=""){

///dd($idPer,$idCar,$dato);
$docentes=DB::table("users")->join('portafolio','users.id','=','portafolio.idDoc')->join('carrera','carrera.id','=','portafolio.idCar')->join('periodo','periodo.id','=','portafolio.idPer')->where('periodo.id','=',$idPer)->where('carrera.id','=',$idCar)->where( function($q) use($dato){
$q->where('users.cedula','like','%'.$dato.'%')->orWhere('users.nombre','like','%'.$dato.'%')->orWhere('users.apellido','like','%'.$dato.'%');
})->select('users.*','portafolio.id as idPor')->orderBy('users.apellido','asc')->Paginate(12);

//select * from users where pais = $pais  and (nombres like %$dato% or apellidos like %$dato%  or email like  %$dato% )
            //  $resultado= $query->where("pais","=",$pais)
              //                    ->Where(function($q) use ($pais,$dato)  {
                //                    $q->where('nombres','like','%'.$dato.'%')
                  //                    ->orWhere('apellidos','like', '%'.$dato.'%')
                    //                  ->orWhere('email','like', '%'.$dato.'%');       
                      //             });

return view("Coordinador.buscarListadoDocente")->with("docentes",$docentes);

}

}
