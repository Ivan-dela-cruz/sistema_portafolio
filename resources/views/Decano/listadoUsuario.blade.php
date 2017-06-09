@extends('principal')
@section('title','Listado Usuarios')
@section('content')
<section class="container-fluid spark-screen">

 
<div class="box box-primary">
	<div class="box-header text-center">
		   <h4 class="box-title"><b>Usuarios registrado en el sistema </b></h4>	
	</div>
<div class="box-body">


<div class="row">
<div class="col-md-2"></div>
	<div class="col-md-4">
		<div class="row">
<label class="col-md-4">Rol Usuario:</label>
		<div class="col-md-8">


<select name="rol" id="rol" required=""  onchange="rolAndTexto()" class="form-control">

<option value="0">Invitado</option>

@if(count($rols))
@foreach($rols as $rls)
	<option class="" value="{{$rls->id}}">{{$rls->name }}</option>
@endforeach
@else
<option value="">No existen Roles registrados</option>
@endif
</select>

		</div>

		</div>

	</div>
    <div class="col-md-4">	<div class="input-group input-group-sm">
					<input type="text" class="form-control" id="dato_buscado" onkeyup="rolAndTexto()" placeholder="Ingresar Cédula o Nombres o Apellidos " name="dato_buscado" required>
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>
				</div>	</div>
    <div class="col-md-2"></div>
</div>



<br>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-2 text-center">
	 <a href="{{ url('/listado_usuario') }}"  class="btn btn-xs btn-primary" >Listado Usuarios</a> 

</div>
<div class="col-md-2 text-center">
	<a href="javascript:void(0);"  data-target="#modalRol" data-toggle="modal" onclick="listadoRol()"  class="btn btn-xs btn-success">
                Roles</a>
</div>	

<div class="col-md-4"></div>

</div>


</div> <!--Cierre box body-->

</div><!--Cierre box primary-->





 






<div class="row">
<div class="col-md-12">
<div class="box-body box box-info" id="rsMostrarUsuarioRol">

</div>
</div>
</div>

</section>
<body onload="rolAndTexto()"></body>

@endsection

@include("Decano.ModalRol")