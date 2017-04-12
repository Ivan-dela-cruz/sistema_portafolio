

<table class="table table-striped">

<tr> 
@foreach($materiaRegistradaPortafolio as $mat)
<th class="text-center"> 
<small>{{ $mat->ciclo }} '{{ $mat->paralelo }}'</small>
<br>
<a href="{{ url('parametros_asignatura/'.$mat->idMatPor) }}"> <img src="{!! url("imagenes/Materia.png") !!}"></a> 

</th>
@endforeach
</tr>
<tr>
@foreach($materiaRegistradaPortafolio as $mat)
<th class="text-center"><span style="font-size:10px">{{$mat->nombreMateria}}</span></th>
@endforeach
</tr>

<tr>
<!--Para eliminar -->
@foreach($materiaRegistradaPortafolio as $mat)
<th class="text-center"><a href="#" class="btn btn-warning btn-xs">Eliminar</a></th>
@endforeach

</tr>

</table>