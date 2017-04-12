<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

use Illuminate\Support\Facades\Validator;

use App\User;
use App\Portafolio;
use App\Periodo;
use App\Carrera;
use App\Ciclo;
use App\Carrera_Ciclo;
use App\Materia;
use App\Ciclo_Materia;
use App\Portafolio_Materia;
use App\Documento;
use App\Parametro;
class DocumentoController extends Controller
{
  public function __construct(){
     $this->middleware('auth');

}


public function subirArchivoPdf(Request $request){


//Id del documento a editar
	$idDocumento=$request->input("documento");
    $descripcion=$request->input("descripcion");
    

$archivo=$request->file('file');
 $input=array('file' => $archivo);
 $reglas=array('file' => 'required|mimes:pdf|max:2000');
 $validar=Validator::make($input,$reglas);
   
if ($validar->fails()) {
 return view("mensajes.msj_rechazado")->with("msj","El archivo no es un pdf o es demasiado Grande para subirlo");
}else{



$nombre_original=$archivo->getClientOriginalName();
$extension=$archivo->getClientOriginalExtension();


$nuevo_nombrePdf="Parametro-".$descripcion."-".$idDocumento.".".$extension;

		 //Nombre del disco creado en filesSytem    
$r1=Storage::disk('archivo')->put($nuevo_nombrePdf, \File::get($archivo) );

$rutaPdf="storage/archivo/".$nuevo_nombrePdf;

		    
		    if ($r1){ 
		    	$documentos=Documento::find($idDocumento);
                $documentos->descripcion=$descripcion;

                $documentos->urlArchivo=$rutaPdf;

                $documentos->save();
		        return view("mensajes.msj_correcto")->with("msj","Pdf agregado correctamente");
		    
		    }
		    else
		    {
		    	return view("mensajes.msj_rechazado")->with("msj"," Error vuelva a intentar :");
		    }



		    //$nuevo_nombre="fotoUser-".$id.".".$extension;
  //$carpeta="PDF";
    //         $ruta=$carpeta."/".$request->input("id_usuario")."_".$archivo->getClientOriginalName();
      //       $r1=Storage::disk('archivos')->put($ruta,  \File::get($archivo) );
        //     $proyecto->ruta=$ruta;



}

}


public function generarPdf($idPorMat){
//dd($idPorMat); 
//Para obtener datos de la portada es decir el periodo i nombre de la carrera
$portadaPortafolio=DB::table('carrera')->join('portafolio','carrera.id','=','portafolio.idCar')->join('periodo','periodo.id','=','portafolio.idPer')->join('portafolio_materia','portafolio.id','=','portafolio_materia.idPor')->where('portafolio_materia.id','=',$idPorMat)->select('carrera.nombre','periodo.*', 'portafolio_materia.nombreMateria')->first();


//dd($portadaPortafolio);

//Documentos de cada parametro que poseen los portafolio 
    $documentoPortafolio=DB::table("portafolio_materia")->join("documento","portafolio_materia.id","=","documento.idPorMat")->join("parametro","parametro.id","=","documento.idPar")->where("documento.idPorMat","=",$idPorMat)->select("documento.*","parametro.nombre")->get();
    //dd($documentoPortafolio);
         return view("Docente.generar")->with('portada',$portadaPortafolio)->with('documento',$documentoPortafolio)->with('idPortafolio',$idPorMat);
}




 public function descargarPdf($idDocu){
         $documento=Documento::find($idDocu);
         $rutaPdf=$documento->urlArchivo;
         return response()->download($rutaPdf);
       }



}
