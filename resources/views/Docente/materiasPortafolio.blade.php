@extends('principal')
@section('title','Asignaturas Portafolio')
@section('content')

<section class="content" id="contenido_principal">


<div class="row box box-success">


<form method="post" action="agregar_materia_portafolio" id="frm_agregar_materia_portafolio" class="form-horizontal form_entrada" >

  <input type="hidden" value="{{ $idPortafolioActual }}"  name="portafolio" id="portafolio"    >
  <input type="hidden" name="_token" value="{{ csrf_token() }}"> 


<br>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8 text-center">
		@foreach($periodoActual as $per)
<legend style="font-size:25px"><b >Período Académico : </b> <span>{!! $per->desde!!}-{!!$per->hasta!!}</span></legend>
<input type="hidden" value="{{ $per->id }}" name="">
@endforeach

	</div>
	<div class="col-md-2"> </div>
</div>



<div class="row">
<div class="col-md-3"></div>
	<div class="col-md-1 "><h4><b>Carrera*:</b></h4></div>
	<div class="col-md-5 form-group">
	@foreach($carreraActual as $carActual)
	<select class="form-control" required="">
		<option value="{{ $carActual->id }}">{{$carActual->nombre}} </option>
	</select>
 <input type="hidden" name="carrera" id="carrera" value="{{ $carActual->id }}" name="">
		@endforeach
	</div>
	<div class="col-md-3"></div>
	
</div>



<div class="row">
<div class="col-md-3"></div>
<div class="col-md-1"> <h4><b>Ciclo*:</b></h4> </div>
<div class="col-md-2 form-group">

<select name="" class="form-control" required="" onchange="cargarMateria(this.value)"> 
<option value="">--Seleccione Ciclo--</option>
<option value="1">PRIMERO</option>
<option value="2"> SEGUNDO</option>
<option value="3">TERCERO</option>
<option value="4">CUARTO</option>
<option value="5">QUINTO</option>
<option value="6">SEXTO</option>
<option value="7">SÉPTIMO</option>
<option value="8">OCTAVO</option>
<option value="9">NOVENO</option>
<option value="10">DÉCIMO</option>
</select> 

</div>

<div class="col-md-1"> <h4>    <b> Paralelo*:</b></h4> </div>

<div class="col-md-2">
@if(count($paralelo))

<select class="form-control" required="" name="paralelo">
     <option value="">Seleccione Paralelo</option>
	@foreach($paralelo as $para)
   <option value="{{ $para->id }}">{{$para->nombre}}</option>

	@endforeach

</select>
    
@else
<select class="form-control"  required="">
	<option value="">No existen Paralelos </option>
</select>
@endif






</div>

<div class="col-md-3"> </div>

</div>






<div class="row">
<div class="col-md-3"></div>
<div class="col-md-1">	<h4><b>Materia*:</b></h4></div>	
<div class="col-md-4">
	<!--la vista cargar_materia.blade.php  ese muestra aqui en este div resultadoMateria pilas -->
<div class="form-group" id="resultadoMateria" > 
<select class="form-control" required="" >
<option value="">--NINGÚNA--</option>
</select>
</div>

</div>
 <div class="col-md-4"></div>
</div>



<div class="row form-group">
<div class="col-md-4"></div>
<div class="col-md-4"> 
<button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Asignaturas</button>
</div>
<div class="col-md-4"></div>
</div>

</form>


</div>



<div class="row box box-primary">

	<div class="row">
<div class="col-md-0"> </div>


<!--SE muestra las asignaturar creadas para el periodo  carrera ciclo paralelo del portafolio docente -->
<div class="text-center col-md-12"  id="notificacionAgregarMateria"> </div>

<div class="col-md-0"></div>

</div>

</div>



<script type="text/javascript">

	setTimeout( "materiasCreadas()",400);
	setTimeout( "materiasCreadas()",600);
</script>

</section>

@endsection
