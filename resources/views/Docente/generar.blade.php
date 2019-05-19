
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


//Para los parametros de las mataeria
        var $archivosMat = array();
        var $parametrosMat=array();

//Para fucionar los parametros asignatura al inicio

 function setParametroMat($archivosMat, $parametrosMat)
        {
            $this->archivosMat = $archivosMat;
            $this->parametrosMat=$parametrosMat;
        }



//Para funcionar los archivo de los paramtros x productos

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


//Para concatenar los parametros asignatura

 function concat2()
        {       
            $j=0;
            foreach ($this->archivosMat as $archivo) {
                //En esta funcion se crean la nueva hoja con los parametros corrspondiente
                  agregarParametro($this, $this->parametrosMat[$j]);
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
        }//Cerrar segundo concat





    }//Cerra la clase concat_pdf 


//Para agragar los separadores
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
         $pdf->Cell(0,70,utf8_decode($archivo),1,1,'C');    
}



//Para la portada por cada producto academico
function agregarPortadaProducto($this,$producto){
      
       $pdf=$this;
       $pdf->AddPage('P','A4');
         $pdf->Ln(90);
         //Negro
        $pdf->SetTextColor(0, 0, 0);
         $pdf->SetFont('Arial','I',35);
         // Movernos a la derecha
         $pdf->Cell(5);
         $pdf->Cell(0,70,utf8_decode($producto),0,1,'C');    
}





//Crear un objeto
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
$pdf->Cell(190,15,utf8_decode($portada->nombre),0,1,'C');
$pdf->Ln(2);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"CICLO:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,utf8_decode($asignatura->ciclo)."  '".$asignatura->paralelo ."'" ,0,1,'C');

$pdf->Ln(2);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"ASIGNATURA:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,utf8_decode($asignatura->materia),0,1,'C');
$pdf->Ln(2);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"DOCENTE:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(0,15,$portada->nomDoc." ".utf8_decode($portada->apeDoc),0,1,'C');

$pdf->Ln(2);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"PERIODO ACADEMICO:",0,1,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,utf8_decode($portada->desde).' - '. utf8_decode($portada->hasta) ,0,1,'C');


//pARA LOS PARAMETROS DE LOS PRODUCTOS
$vArchivo= array();
$vParametro= array();

//pRA LOS PRODUCTOS ACADEMICOS
$vProductoAcademico = array();


//pARA LOS PARAMETROS DE LAS ASIGNATURA
$vArchivoMat=array();
$vParametroMat=array();









//Todos los documentos que poseen los paramertos Asignaturas

foreach ( $documentosAsiPara as $docParMat) {
    //Los parametros
    $vParametroMat[]=$docParMat->parametroMat;

    //Los archivos
 $vArchivoMat[]=$docParMat->urlArchivo;   
}



//Consultar todos los productos acdemicos  para des pue clasificar segun producto 1 , 2,3 ,4 
foreach ($productoAll as $prodAll) {
  //$vArchivo[]='storage/archivo/Portada-'.$idPortafolio.'.pdf';
$vProductoAcademico[]=$prodAll->nombre;

foreach($documento as $docu){ //Todos los documetos que poseen esos parametros para luego clasificarlo

    if ($prodAll->id==$docu->idProAca) {//Clasificar segun el parametr Acedemico
 
 //Los parametros
        $vParametro[]=$docu->parametro;
//Los archivos

 $vArchivo[]=$docu->urlArchivo;  
                           }    

                    }



}





//Envia la ruta del almacenamiento y los parametros
$pdf->setParametroMat($vArchivoMat,$vParametroMat);
//$pdf->setFiles(array('B.pdf', 'A.pdf','B.pdf'));
$pdf->concat2();


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