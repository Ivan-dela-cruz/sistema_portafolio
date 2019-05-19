<div class="row">
	<div class="col-md-1"></div>
<div class="col-md-10 text-center">
	@foreach($actividadPortafolio as $actPor)
<b><label style="color:blue;">Actividades Docencia</label></b><br>
<a href="{{ url('archivo_actividad/'.$actPor->id) }}"  title="Ver archivos Actividad"><img src="{{ url('imagenes/Activity.png') }} "></a>

	@endforeach


</div>
<div class="col-md-1"></div>

</div>