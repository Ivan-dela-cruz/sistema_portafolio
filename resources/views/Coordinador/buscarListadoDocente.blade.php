
<div class="col-md-0"></div>
<div class="col-md-12">

@if(count($docentes))

<table class="table table-striped text-center  table-responsive" width="100%">
<thead>
<tr class="bg-green text-white"><th>Cédula</th> <th>Apellidos</th> <th>Nombres</th><th>Teléfono</th> <th>Dirección</th> <th colspan="2" class="text-center">Acción</th></tr>
</thead>


<tbody>


@foreach($docentes as $doc)
    <tr class="bg-gray">
<td>{{$doc->cedula}}</td> <td>{!! $doc->apellido!!}</td> <td>{{ $doc->nombre }}</td> <td>{{ $doc->celular}}</td> <td>{{$doc->direccion  }}</td> 
<td   class="text-center" colspan="2" ><a class="btn btn-info btn-xs" href="{{ URL::to('getPDF').'/'.base64_encode($doc->id)}}" target="black">Perfil Docente</a>  <input  value="{{$doc->idPor}}" class="btn btn-xs btn-success" value="Reporte Verificación" type="button" name="">  
<a  class="btn btn-primary btn-xs" href="{{ URL('reporte_cumplimiento/'.$doc->idPor) }}">Reporte Cumplimiento</a> </td>
   </tr>

@endforeach

</tbody>

</table>
@else
<legend class="text-center">Docente no Registrados o Portafolio no creado </legend>
@endif

</div>
<div class="md-col-0"></div>



<div class="row">

<div class="col-md-2 text-center">
		<b  style="color:blue">Docentes encontrados :</b> <b style="color:black">{{count($docentes) }}</b>
</div>
<div class="col-md-8 text-center">

</div>

<div class="col-md-2 text-center">
@php

       echo str_replace('/?', '?', $docentes->render());
@endphp

</div>

</div>





