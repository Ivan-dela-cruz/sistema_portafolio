@php 
require_once('fpdf/fpdf.php');
require_once('fpdi/fpdi.php');


$pdf=new FPDF();
//Primera página
$pdf->AddPage();


$imgen="imagenes/caratula.png";

$pdf->Image($imgen, 5 ,5, 200 , 130,'png', '');


//$pdf->Image('imagenes/logo.png', 65 ,60, 85 , 40,'png', '');

//$pdf->SetFont('Arial','B',18);
//$pdf->Cell(38,20);
//$pdf->Write(200,'UNIVERSIDAD TECNICA DE COTOPAXII');




//$pdf->SetFont('Arial','I',18);
//$pdf->Write(78,'FACULTAD DE CIENCIAS DE LA INGENIERIA Y APLICADAS');

$pdf->Ln(140);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(80,20);
$pdf->Write(10,'CARRERA :');
$pdf->Ln(14);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$portada->nombre,0,1,'C');

$pdf->Ln(16);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(75,20);
$pdf->Write(10,'ASIGNATURA :');
$pdf->Ln(14);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$portada->nombreMateria,0,1,'C');

$pdf->Ln(16);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(65,20);
$pdf->Write(10,'PERIODO ACADEMICO :');
$pdf->Ln(14);
$pdf->SetFont('Arial','I',15);
$pdf->Cell(190,15,$portada->desde.' - '. $portada->hasta ,0,1,'C');

//$pdf=new FPDF('L','mm','A4')
$pdf->Output('storage/archivo/Portada-'.$idPortafolio.'.pdf','F');






class concat_pdf extends FPDI{
     var $files = array();
     var $parametro=array();
    function setFiles($files, $parametros){
        $this->files = $files;
        $this->parametro=$parametros;
    }
function concat(){
//Muestra la url de todos los archivos que van hacer fucionado 
  
$j=0;

foreach($this->files AS $file){
if ($j>0){
$i=0;
foreach ($this->parametro AS $archi) {
  if($j==$i+1) {
        $this->AddPage('L','A4');
         $this->Ln(50);
         $this->SetFont('Arial','I',40);
         // Movernos a la derecha
         $this->Cell(15);
         $this->Cell(250,70,$this->parametro[$i],1,1,'C');
         break;

         }
$i++;
                                    }
       }

            $pagecount = $this->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++){
                $tplidx = $this->ImportPage($i);
                $s = $this->getTemplatesize($tplidx);
                $this->AddPage($s['h'] > $s['w'] ? 'P' : 'L');
                $this->useTemplate($tplidx);         
                                              }

$j++;
                               }
              }


}

$pdf= new concat_pdf();
//Para guardar el ruta de la imagen
$vector= array();
$vectorparametro= array();

$vector[]='storage/archivo/Portada-'.$idPortafolio.'.pdf';
foreach($documento as $docu){

if ($docu->urlArchivo!="") {

     $vectorparametro[]=$docu->descripcion;
     $vector[]=$docu->urlArchivo;  

                           }
                    }

//Envia la ruta del almacenamiento y los parametros
$pdf->setFiles($vector, $vectorparametro);
//$pdf->setFiles(array('B.pdf', 'A.pdf','B.pdf'));
$pdf->concat();
// $pdf->Output('paginas.pdf','F');

//$pdf->Output();

$pdf->Output('storage/archivo/Portafolio-'.$idPortafolio.'.pdf','F');
@endphp

 <a href="{{url('storage/archivo/Portafolio-'.$idPortafolio.'.pdf')}}"  target="_blank" class="btn btn-info btn-sm"> Visualizar </a>  

