
<div class="col-md-0"></div>

<div class="col-md-12 table-responsive">

	@if(count($docentes))

	<table class="table table-striped text-center  table-responsive" width="100%">
		<thead>
			<tr class="bg-green text-white"><th>Cédula</th> <th>Apellidos</th> <th>Nombres</th><th>Teléfono</th> <th>Dirección</th> <th>Fecha Registro</th> <th colspan="2" class="text-center">Acción</th></tr>
		</thead>


		<tbody>

			@foreach($docentes as $doc)
			<tr class="bg-gray">
				<td>{{$doc->cedula}}</td> <td>{!! $doc->apellido!!}</td> <td>{{ $doc->nombre }}</td> <td>{{ $doc->celular}}</td> <td>{{$doc->direccion  }}</td> <td>{{$doc->created_at}}</td>
				<td   class="text-center" colspan="2" ><a class="btn btn-danger btn-xs" href="{{ URL::to('getPDF').'/'.base64_encode($doc->id)}}" target="black">Perfil Docente</a> 

					<a  class="btn btn-primary btn-xs" href="{{ URL('reporte_cumplimiento/'.$doc->idPor) }}">Reporte Verificación</a>&nbsp;<a class="btn btn-primary btn-xs" href="{{url('reporte_actividad/'.$doc->idPor)}}">Actividades Docencia</a> 

					</td>
				</tr>

				@endforeach

			</tbody>

		</table>
		@else
		  <div class="alert alert-warning text-center">

        <label >
              Docente no Registrados o Portafolio no creado</label>
         </div>


		
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





