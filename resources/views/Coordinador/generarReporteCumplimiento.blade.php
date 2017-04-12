<!DOCTYPE html>
<html>
<head>
	<title>Reporte Cumplimiento</title>

	<style>
    @php include(public_path().'/bootstrap/css/bootstrap.min.css');@endphp


body {
  font-family: "Times New Roman", serif;
  margin-top:1mm;
}

html{
    margin-top: 1mm;
}
	
    </style>



</head>



<body>


<div class="row">
<div class="col-md-12 text-center "><img src="imagenes/ciya.png" style="height:130px; weight:500px"></div>
</div>

<div class="row">
	<div class="col-md-2"></div>
 <div class="col-md-8 text-center">
 <br>
  <b style="font-size:17px">PERÍODO ACADÉMÍCO :</b><span style="font-size:17px"> {{ $portafolio->desde }}-{!!$portafolio->hasta!!}</span></div>

<div class="col-md-2"></div>
</div>


<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<br>
<table class="table table-condensed">
<tr>
	<td colspan="2" ><b style="font-size:14px"> CARRERA: </b><span style="font-size:14px">{{$portafolio->carrera}}</span> </td>
	<td><b style="font-size:14px">CICLO: </b> <span style="font-size:14px">{{ $asignaturas->ciclo }}</span></td>
	<td><b style="font-size:14px">PARALELO: </b> <span style="font-size:14px">{{$asignaturas->paralelo  }}</span></td>
</tr>
<tr>
<td colspan="2"><b style="font-size:14px">DOCENTE: </b><span style="font-size:14px">{{$portafolio->nombreDoc}} {{$portafolio->apellidoDoc}}</span></td>
<td colspan="2"><b style="font-size:14px">ASIGNATURA: </b><span style="font-size:14px">{{$asignaturas->materia}}</span></td>
</tr>

</table>
</div>
<div class="col-md-2"></div>
</div>


<div class="row">
	<div class="col-md-12 text-center">
		<b style="font-size:18px">REPORTE CUMPLIMIENTO DOCENTE </b>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-12">
	 <table class="table table-bordered">
    <thead>
      <tr class="bg-primary text-white">
        <th>PARAMETROS</th>
        <th>SI</th>
        <th>NO</th>
      </tr>
    </thead>
    <tbody>
      
@foreach($parametros as $par)
      <tr> 
        <td>{{ $par->nombre}}</td>
        <td> </td>
        <td></td>
      </tr>
@endforeach

    </tbody>
  </table>

	</div>

</div>


