@php

require_once('fpdf/fpdf.php');
require_once('fpdi/fpdi.php');



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
  if($j==$i+1) 
          {
        $this->AddPage('L','A4');
         $this->Ln(50);
         $this->SetFont('Arial','I',40);
         // Movernos a la derecha
         $this->Cell(15);
         $this->Cell(250,70,$this->parametro[$i],1,1,'C');
         
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

$pdf->Output('storage/archivo/Paginas.pdf','F');

@endphp
