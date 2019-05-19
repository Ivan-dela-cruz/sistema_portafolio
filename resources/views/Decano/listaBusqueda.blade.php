

   <div class="table-responsive">
		@if(count($usuarios))

		<table class="table table-hover table-striped" cellspacing="0" width="100%">	
		<thead>
		<tr class=" bg-green  text-white">		
		    <th>Cedula</th>
			<th>Rol</th>
			<th>Usuario</th>
			<th>Celular</th>
			<th>Email</th>
			<th>Fecha Registro</th>
			<th>Acción</th>
		</tr>
		</thead>
            <tbody>
	@foreach($usuarios as $user)
<tr class="text-black" > 
<td>{!!$user->cedula!!}</td>
<td>

<span class="label label-default"> 
@foreach($user->getRoles() as $roles)
{!! $roles."," !!}
@endforeach


-</span> 

</td>

<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $user->nombre. " ". $user->apellido }} </a></td>

<td>{!! $user->celular !!}</td>
<td>{!! $user->email !!}</td>
<td>{{$user->created_at  }} </td>

<td>
<a href="{{ url('asignar_rol_usuario/'.$user->id) }}"  title="Editar Rol Usuario"   class="btn btn-warning btn-xs"> <i class="fa  fa-edit"></i></a>
<button title="Eliminar Usuario" onclick="eliminarUsuario('{{$user->id }}')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
</td>
</tr>

	@endforeach
           </tbody>
		</table>

@else
<div class="alert alert-danger text-center">
  <strong>Usuarios!</strong> no registrados.
</div>

@endif
</div>
<div class="row">

		<div class="col-md-2 text-center">
			<b  style="color:blue">Docentes encontrados :</b> <b style="color:black">{{count($usuarios) }}</b>
		</div>
		<div class="col-md-8 text-center">
		</div>
		<div class="col-md-2 text-center">
			@php
			echo str_replace('/?', '?', $usuarios->render());
			@endphp
		</div>

	</div>

