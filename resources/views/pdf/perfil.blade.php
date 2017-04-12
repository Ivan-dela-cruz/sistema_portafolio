
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Perfil Docente</title>



		<style type="text/css">
		    table td, table th{
		        border:1px solid black;
		    }
		</style>

		   <!-- Bootstrap 3.3.5 -->
		</head>
		<body>
		 <div >	 	
		 </div>
		<div class="col-md-12">
		              
		              <div class="">
		                <div  align="center">
		                
		                <div><img align="left" id="" src="imagenes/iconutc.png"  style="width:15%"></div>
		                <h2>Universidad Tecnica de Cotopaxi</h2>

		                <button type="submit" class="btn btn-info">Actualizar Datos</button>

		                <u><h3>Datos Informativos personal Docente</h3></u>
		                </div><!-- /.box-header -->
		                <div>
		                <br>
		                <u><h3>Datos personales</h3></u>	
		                
						@if($users->foto)
		                @php 
		                $fotoUser=$users->foto;
		                @endphp
		                  @else
		                   @php $fotoUser="imagenes/avatar.png"; @endphp 
		                  @endif
		                 
		                  <div>
		                  	<img align="right" style="width: 120px; height:150px;" src="{{ $fotoUser }}" alt="User profile picture">
		                  </div>
		                <p>APELLIDOS:{!!$users->apellido!!}</p>
		                <p>NOMBRES:{!!$users->nombre!!}</p>
		   				
		                

		                
						<p>CEDULA DE CIUDADANÍA: {!!$users->cedula!!}</p>  
						<p>NÚMERO DE CARGAS FAMILIARES: {!!$users->cargaFamiliar!!} <p>
						<p>LUGAR Y FECHA DE NACIMIENTO: {!!$users->lugarNacimiento!!} {!!$users->fechaNacimiento!!}<p>
						<p>DIRECCIÓN DOMICILIARIA: {!!$users->direccion!!} <p>
						<p>TELÉFONO CONVENCIONAL: {!!$users->telefono!!}    TELÉFONO CELULAR: {!!$users->celular!!}<p>
						<p>EMAIL INSTITUCIONAL: {!!$users->email!!}<p>
						<p>ESTUDIOS REALIZADOS Y TÍTULOS OBTENIDOS:  <p>

		                 
						</div>

		               <table>
		               	<thead>
		               	<tr>
							<th >NIVEL</th>
							<th >TITULO OBTENIDO</th>
						 	 <th >FECHA DE REGISTRO</th>
						 	 <th >CÓDIGO DEL REGISTRO CONESUP O SENESCYT</th>
						</tr>
		               	</thead>
		               	<tbody>
					 	  @foreach($nivel as $nv)
		                    @foreach($titulo->get() as $titu)
		                        @if($titu->idNivel==$nv->id)
					 	 <tr>
						 	 <td >
								{{ $nv->nombre }} 
							</td>
		                
		              
		                
						 	

						 	<td >
			                 {{$titu->nombre}}

		 					</td>
						 	 
						 	 <td >
							{{$titu->fechaRegistro}}
						 	 </td>
							 <td >
							{{$titu->codigoRegistro}}
							@endif
							 </td>
		                      @endforeach    
		                    
		                         
		                     </tr>
		                     @endforeach
							</tbody>
							</table>
		                <br>
		                <u>HISTORIAL PROFESIONAL:</u>
						<p>FACULTAD EN LA QUE LABORA: Ciencias de la Ingeniería y Aplicadas</p>
						<p>ÁREA DEL CONOCIMIENTO EN LA CUAL SE DESEMPEÑA: Ciencias, Subárea: Informática</p>
						<p>FECHA DE INGRESO A LA UTC: {!!$users->fechaIngresoUtc!!}</p>

						
		              </div><!-- /.box -->



		              
		            </div>


			
		</body>
		</html>


