<div class="row">
	<div class="col-md-4"></div>
<div class="col-md-4 text-center">
	<ul>
	@foreach($archivoCategoria as $archCat)
		<li> <b>{{ $archCat->actividad}}</b> 
<br>

@if($archCat->urlArchivo)
		<a  title="Visualizar archivo Pdf" href="{{url($archCat->urlArchivo)}}" target="_blank"> <img src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a> 

<br>
    @php

$date = new DateTime($archCat->updated_at);
//$fecha=  $date->format('Y-m-d H:i:s');

$fecha=  $date->format('Y-m-d');
//$fecha=date("d-m-Y (H:i:s)", $date);


     @endphp

      <label> {{ $fecha }}</label>  <br>

          <br>
  <a href="javascript:void(0);" onclick="eliminarArchivoActividad('{{$archCat->id }}')" title="Eliminar Archivo " class="btn btn-danger"><span class="fa fa-trash"></span></a>
                 

                
            <a  class="btn btn-success"  title="Descargar Archivo" href="{{ url('descargar_pdf_actividad/'.$archCat->id) }}"><span class="glyphicon glyphicon-save"> </span></a>
                                  




@else
 <a title="No existe Archivo" href="javascript:void(0);"><img src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px";> </a>
   
<br>
<b> <span style="color:blue;">
                                            No existe 
                                        </span></b>
@endif

		</li>
    <br>

    @endforeach
	</ul>

</div>
<div class="col-md-4"></div>
</div>