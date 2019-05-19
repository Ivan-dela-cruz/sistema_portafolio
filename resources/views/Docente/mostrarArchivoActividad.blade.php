<div class="row">
	<div class="col-md-4"></div>
<div class="col-md-4 text-center">
	<ul>
	@foreach($archivoCategoria as $archCat)
		<li> <b>{{ $archCat->actividad}}</b> 
<br>

@if($archCat->urlArchivo)
		<a  title="Visualizar archivo Pdf" href="{{url($archCat->urlArchivo)}}" target="_blank"> <img src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a> 
          <br> <a class="glyphicon glyphicon-save" href="{{ url('descargar_pdf_actividad/'.$archCat->id) }}">Descargar </a>
@else
 <a title="No existe Archivo" href="javascript:void(0);"><img src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px";> </a>
<br>
 <button class="btn btn-primary btn-xs" data-target="#modalSubirActividad" data-toggle="modal" onclick="getIdActividad('{{$archCat->id }}', '{{ $archCat->actividad }}')" type="button">
                                        <span class="glyphicon glyphicon-open">
                                            _Subir
                                        </span>
                                    </button>

@endif

		</li>
    <br>

    @endforeach
	</ul>

</div>
<div class="col-md-4"></div>
</div>