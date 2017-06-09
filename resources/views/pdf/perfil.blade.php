
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Perfil Docente</title>


	<style>
		@php include(public_path().'/bootstrap/css/bootstrap.min.css');@endphp

		body {
			font-family: "Times New Roman", serif;
			margin-top:1mm;
		}

		html{
			margin-top: 0mm;
		}
img { border: 2px solid black; }

	</style>


	<!-- Bootstrap 3.3.5 -->
</head>

<body >
<!--<body  background="/imagenes/fondo.png">-->
<div class="row">
	<div class="col-md-12 text-center "><img src="imagenes/ciyaN.png" style="height:104px; weight:350px"></div>
</div>
<div  class="row text-center">
	<u><h3>Datos Informativos personal Docente</h3></u>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<br>
		<u><h4>Datos Personales</h4></u>

		@if($users->foto)
		@php
		$fotoUser=$users->foto;
		@endphp
		@else
		@php $fotoUser="imagenes/avatar.png"; @endphp
		@endif

		<p><b>APELLIDOS:&nbsp;</b>{!!$users->apellido!!}</p>
		<p><b>NOMBRES:&nbsp;</b>{!!$users->nombre!!}</p>


@php

$estado="";
if ($users->estadoCivil==0) {                 
           $estado = "";
                           }
                                 

if ($users->estadoCivil==1) {                 
           $estado = "Casado(a)";
                           }

if ($users->estadoCivil==2) {                 
           $estado = "Divorciodo(a)";
                           }
                                
if ($users->estadoCivil==3) {                 
           $estado = "Separado(a)";
                           }


 if ($users->estadoCivil==4) {                 
           $estado = "Soltero(a)";
                           }
                       
if ($users->estadoCivil==5) {                 
           $estado = "Union Libre";
                           }

if ($users->estadoCivil==6) {                 
           $estado = "Viudo(a)";
                           }


                             
@endphp    

    <p><b>ESTADO CIVIL:&nbsp;</b>{!!$estado!!}</p>

		
		<p><b>CÉDULA DE CIUDADANÍA:</b> {!!$users->cedula!!}</p>

@php 
if ($users->cargaFamiliar==0) {
	$numFamiliar="";}
	else{
$numFamiliar=$users->cargaFamiliar-1;
	}
@endphp

		<p><b>NÚMERO DE CARGAS FAMILIARES:</b> {!!$numFamiliar!!} <p>

@if(!$users->fechaNacimiento=="")
@php 
$date = new DateTime($users->fechaNacimiento);
//$fecha=  $date->format('Y-m-d H:i:s');
$fechaNacimiento=  $date->format('d-m-Y');
@endphp
@else
 @php $fechaNacimiento="";
@endphp
@endif


			<p><b>LUGAR Y FECHA DE NACIMIENTO:</b> {!!$users->lugarNacimiento!!}, {!!$fechaNacimiento!!}<p>
				<p><b>DIRECCIÓN DOMICILIARIA:</b> {!!$users->direccion!!} <p>
					<p><b>CELULAR:</b> {!!$users->celular!!} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TELÉFONO: </b> {!!$users->telefono!!}<p>
						<p><b>EMAIL INSTITUCIONAL:</b> {!!$users->email!!}<p>
							
							<b><u>ESTUDIOS REALIZADOS Y TÍTULOS OBTENIDOS: </u> </b>

						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<br><br>
							<img border="2"  style="width: 120px; height:150px;" src="{{ $fotoUser }}" alt="User profile picture" >

						</div>
					</div>
					
					<div class="row">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


							<table class="table table-bordered table-condensed">
								<thead>
									<tr>
										<th class="text-center">NIVEL</th>
										<th class="text-center">TITULO OBTENIDO</th>
										<th class="text-center">FECHA DE REGISTRO</th>
										<th class="text-center">CÓDIGO DEL REGISTRO CONESUP O SENESCYT</th>
									</tr>
								</thead>
								<tbody>
									@foreach($nivel as $nv)
									@foreach($titulo->get() as $titu)
									@if($titu->idNivel==$nv->id)
									<tr>
										<td class="text-center">
											{{ $nv->nombre }}
										</td>
										<td class="text-center">
											{{$titu->nombre}}

										</td>

										<td class="text-center">
											{{$titu->fechaRegistro}}
										</td>
										<td class="text-center">
											{{$titu->codigoRegistro}}
											@endif
										</td>
										@endforeach
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<u><b>HISTORIAL PROFESIONAL:</b></u>
									<br><br>
									<p><b>FACULTAD EN LA QUE LABORA:</b> Ciencias de la Ingeniería y Aplicadas</p>
									<p><b>ÁREA DEL CONOCIMIENTO EN LA CUAL SE DESEMPEÑA:</b> Ciencias, Subárea: Informática</p>
									<p><b>FECHA DE INGRESO A LA UTC:</b> {!!$users->fechaIngresoUtc!!}</p>
								</div>
							</div>




						</div>

					</div>
					<br><br><br><br><br><br><br><br>
					<div class="row">
								<div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<p>......................................</p>
									<p><b>FIRMA</b></p>

								</div>
							</div>




				</body>
				</html>





