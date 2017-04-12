<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\Nivel;
use App\Titulo;
use App\Portafolio;
use App\Carrera_Ciclo;
use App\Carrera;
use App\Ciclo;
use App\Periodo;
use App\Paralelo;
use App\Portafolio_Materia;
use App\Parametro;
use App\Materia;
use App\Documento;
use Illuminate\Support\Facades\DB;




class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function __construct(){
   $this->middleware('auth');
   }
    public function get($id)
    {

        //$rutaPdf="pdfconsolidado/hojadevida";   

 $idDoc=base64_decode($id);

        $users=User::find($idDoc);
        $nivels=Nivel::all();
        $titulo=$users->titulos();
        
        $pdf=PDF::loadView('pdf.perfil',['users'=>$users,'nivel'=>$nivels,'titulo'=>$titulo]);
        return $pdf->stream('perfil.pdf');
    
        //if($tipo==1){return $pdf->stream('perfil.pdf');}
        //if($tipo==2){return $pdf->download('perfil.pdf'); }
    
    }


       

public function descargar($id){

    $idDoc=base64_decode($id);
        $users=User::find($idDoc);
        $nivels=Nivel::all();
        $titulo=$users->titulos();
        $pdf=PDF::loadView('pdf.perfil',['users'=>$users,'nivel'=>$nivels,'titulo'=>$titulo]);
       //Nombre del pDf
        return $pdf->download('perfil.pdf');
}
  
        
public function generarReporteCumplimiento($idPorta,$idPorMat){

//PARA EL MENBRETE

 $portafolio=DB::table('portafolio')->join('periodo','periodo.id','=','portafolio.idPer')->join('carrera','carrera.id','=','portafolio.idCar')->join('users','users.id','=','portafolio.idDoc')->where('portafolio.id','=',$idPorta)->select('periodo.*','portafolio.nombre as portafolio','carrera.nombre as carrera','users.nombre as nombreDoc','users.apellido as apellidoDoc')->first();


//dd($portafolio);
//Para consultar ciclo paralelo Asignatura

$materiasCreadas=DB::table('portafolio')->join('portafolio_materia','portafolio.id','=','portafolio_materia.idPor')->join('paralelo','paralelo.id','=','portafolio_materia.idPar')->join('materia','materia.id','=','portafolio_materia.idMat')->join('carrera_ciclo','carrera_ciclo.id','=','materia.idCarCic')->join('ciclo','ciclo.id','=','carrera_ciclo.idCic')->where('portafolio.id','=',$idPorta)->where('portafolio_materia.id','=',$idPorMat)->select('portafolio_materia.id as idPorMat','ciclo.nombre as ciclo','paralelo.nombre as paralelo','materia.nombre as materia')->first();  

$parametro= DB::table('parametro')->orderby('id','asc')->get(); 

$pdf=PDF::loadView('Coordinador.generarReporteCumplimiento',['portafolio'=>$portafolio,'asignaturas'=>$materiasCreadas,'parametros'=>$parametro]);


        return $pdf->stream('Reporte_Cumplimiento.pdf');

}


    public function index(){
    
        return view("pdf.listado_reportes");
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
