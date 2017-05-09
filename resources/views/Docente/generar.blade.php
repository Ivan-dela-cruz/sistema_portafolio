
@php 
require_once('fpdf/fpdf.php');
require_once('fpdi/fpdi.php');
header('Content-type: application/pdf');

//$pdf=new FPDF();
//Primera página

//$pdf=new FPDF('L','mm','A4')
//$pdf->Output('storage/archivo/Portada-'.$idPortafolio.'.pdf','F');




   class concat_pdf extends FPDI
    {
        var $archivos = array();
        var $parametros=array();
        var $productos=array();
        var $separadorProducto;

        function setFiles($archivos, $parametros, $productos)
        {
            $this->archivos = $archivos;
            $this->parametros=$parametros;
            $this->productos=$productos;
           
//Divide el total de archivos por el numero de productos para realizar los separadode de cada producto
           $this->separadorProducto= count($parametros)/count($productos);
        }
        function concat()
        {       
            $j=0;
            $p=0;


//Obtine el nuenro de productos 
 $sepa=$this->separadorProducto;
 //$this->$separadorProducto;
     
            foreach ($this->archivos as $archivo) {
                
if ($sepa==$this->separadorProducto) {

    //Agrega el seprador del producto correspondiente
    agregarPortadaProducto($this, $this->productos[$p]);
    $p++;
 $sepa=0;
}
           $sepa++;      
                   //En esta funcion se crean la nueva hoja con los parametros corrspondiente     
                  agregarParametro($this, $this->parametros[$j]);

                

            $j++;
             //Debe exitir el archivo a hacer subido para comcatener archivos
if ($archivo!="") {
   $pagecount = $this->setSourceFile($archivo);
                for ($i = 1; $i <= $pagecount; $i++) {
                    $tplidx = $this->ImportPage($i);
                    $s      = $this->getTemplatesize($tplidx);
                    $this->AddPage($s['h'] > $s['w'] ? 'P' : 'L');
                    $this->useTemplate($tplidx);
                }

}

            }
        }
    }


function agregarParametro($this,$archivo){
      
       $pdf=$this;
       $pdf->AddPage('L','A4');
         $pdf->Ln(50);
         //VERde
         $pdf->SetDrawColor(0, 100, 0);
         //AZUL
        $pdf->SetTextColor(0,80,180);
         $pdf->SetFont('Arial','I',40);
         // Movernos a la derecha
         $pdf->Cell(15);
         $pdf->Cell(0,70,$archivo,1,1,'C');    
}


function agregarPortadaProducto($this,$producto){
      
       $pdf=$this;
       $pdf->AddPage('P','A4');
         $pdf->Ln(90);
         //Negro
        $pdf->SetTextColor(0, 0, 0);
         $pdf->SetFont('Arial','I',52);
         // Movernos a la derecha
         $pdf->Cell(15);
         $pdf->Cell(0,70,$producto,0,1,'C');    
}





$pdf= new concat_pdf();
//Para guardar el ruta de la imagen


//Para la portada
$pdf->AddPage();
$imgen="imagenes/caratula.png";

$pdf->Image($imgen, 5 ,5, 200 , 130,'png', '');

//$pdf->Image('imagenes/logo.png', 65 ,60, 85 , 40,'png', '');

//$pdf->SetFont('Arial','B',18);
//$pdf->Cell(38,20);
//$pdf->Write(200,'UNIVERSIDAD TECNICA DE COTOPAXII');
//$pdf->SetFont('Arial','I',18);
//$pdf->Write(78,'FACULTAD DE CIENCIAS DE LA INGENIERIA Y APLICADAS');

$pdf->Ln(130);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"CARRERA:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$portada->nombre,0,1,'C');
$pdf->Ln(2);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"CICLO:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$asignatura->ciclo."  '".$asignatura->paralelo ."'" ,0,1,'C');

$pdf->Ln(2);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"ASIGNATURA:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$asignatura->materia,0,1,'C');
$pdf->Ln(2);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"DOCENTE:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(0,15,$portada->nomDoc." ".$portada->apeDoc,0,1,'C');

$pdf->Ln(2);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"PERIODO ACADEMICO:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$portada->desde.' - '. $portada->hasta ,0,1,'C');


$vArchivo= array();
$vParametro= array();
$vProductoAcademico = array();





//Consultar todos los productos acdemicos  para des pue clasificar segun producto 1 , 2,3 ,4 
foreach ($productoAll as $prodAll) {
  //$vArchivo[]='storage/archivo/Portada-'.$idPortafolio.'.pdf';
$vProductoAcademico[]=$prodAll->nombre;

foreach($documento as $docu){ 

    if ($prodAll->id==$docu->idProAca) {//Clasificar segun el parametr Acedemico
 $vParametro[]=$docu->parametro;
 $vArchivo[]=$docu->urlArchivo;  
                           }    

                    }



}



//Envia la ruta del almacenamiento y los parametros
$pdf->setFiles($vArchivo,$vParametro,$vProductoAcademico);
//$pdf->setFiles(array('B.pdf', 'A.pdf','B.pdf'));
$pdf->concat();
// $pdf->Output('paginas.pdf','F');
ob_end_clean();

$pdf->Output('Portafolio.pdf','I');
//Para guardr en una ruta
//$pdf->Output('storage/archivo/Portafolio-'.$idPortafolio.'.pdf','F');

//Para ver archivos guardados
@endphp


<!--
<a class="glyphicon glyphicon-eye-open btn btn-default" href="{{url('storage/archivo/Portafolio-'.$idPortafolio.'.pdf')}}" target="_blank">Visualizar</a>
-->