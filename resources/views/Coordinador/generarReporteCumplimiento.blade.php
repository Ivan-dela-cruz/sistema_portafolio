<!DOCTYPE html>
<html>
<head>
	<title>Reporte Cumplimiento</title>

	<style>

    @php
  // include(public_path().'/bootstrap/css/bootstrap.min.css');

    @endphp


.tabla {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
text-align:center;
width: 720px;
} 


.tabla th {
padding: 5px;
font-size: 16px;
background-color: #83aec0;
background-repeat: repeat-x;
color: #FFFFFF;
border-right-width: 1px;
border-bottom-width: 1px;
border-right-style: solid;
border-bottom-style: solid;
border-right-color: #558FA6;
border-bottom-color: #558FA6;
font-family: "Trebuchet MS", Arial;
text-transform: uppercase;
}





.tabla .modo1 {
font-size: 12px;
font-weight:bold;
background-color: #e2ebef;
background-repeat: repeat-x;
color: #34484E;
font-family: "Trebuchet MS", Arial;
}

.tabla .modo1 td {
padding: 5px;
border-right-width: 1px;
border-bottom-width: 1px;
border-right-style: solid;
border-bottom-style: solid;
border-right-color: #A4C4D0;
border-bottom-color: #A4C4D0;

}

.imagen{
  margin-top:-55px;
}



      p { page-break-after: always; }
      .footer { position: fixed; bottom: 100px; }
      .pagenum:before { content: counter(page); }
    

</style>



</head>



<body>

<br>



<div   class="row">
<div  align="center" ><img  class="imagen"  src="imagenes/ciyaN.png" style="height:100px; width:790px;"></div>
</div>
<br>


<div class="row" align="center">
  <b style="font-size:17px; ">PERÍODO ACADÉMÍCO :</b><span style="font-size:17px;"> {{ $portafolio->desde }}-{!!$portafolio->hasta!!}</span>
  </div>

<br>
<div class="row" align="center">
  <b style="font-size:17px; ">CARRERA: </b><span style="font-size:17px;">{{$portafolio->carrera}}</span></div>
<br>


<table>
  <tr>
  <td colspan="2"  style="width:450px; height:30px;"><b style="font-size:15px">ASIGNATURA: </b><span style="font-size:14px">{{$asignaturas->materia}}</span></td>
	<td colspan="1" style="width:150px;"><b style="font-size:15px;">CICLO: </b> <span style="font-size:14px;">{{ $asignaturas->ciclo }}</span></td>
	<td colspan="1" style="width:150px;"><b style="font-size:15px;">PARALELO: </b> <span style="font-size:14px;">{{$asignaturas->paralelo  }}</span></td>
</tr>
<tr>
<td colspan="4"><b style="font-size:15px;">DOCENTE: </b><span style="font-size:14px;">{{$portafolio->nombreDoc}} {{$portafolio->apellidoDoc}}</span></td>
</tr>
</table>

<br>

	<div align="center">
		<b style="font-size:18px;">REPORTE CUMPLIMIENTO DOCENTE </b>
	<br><br>
  </div>



<table class="tabla">
 <thead>
      <tr  class="modo1">
        <th>N°</th>      
        <th>PARÁMETRO PORTAFOLIO</th>
        <th>SI</th>
        <th>NO</th>
      </tr>
    </thead>
@foreach($parametroPorta as $parPorta)
<tr  class="modo1"> 
        <td> <b>*</b></td>
        <td align="left"><small style="font-size:15px;">{{ $parPorta->parametro}}</small></td>
@if($parPorta->urlArchivo)
<td align="center"><img style="height:16px; width:16px;" src="imagenes/si.png"></td> 
<td align="center"></td>
  @else
<td align="center"></td>
  <td align="center"><img style="height:17px; weight:18px" src="imagenes/no.png"></td>
  @endif
      </tr>

@endforeach

</table>












<table class="tabla">
 <thead>
      <tr  class="modo1">
        <th>N°</th>      
        <th>PARÁMETRO ASIGNATURA</th>
        <th>SI</th>
        <th>NO</th>
      </tr>
    </thead>
@foreach($parametroMat as $parMat)
<tr  class="modo1"> 
        <td> <b>*</b></td>
        <td align="left"><small style="font-size:15px;">{{ $parMat->nombre}}</small></td>
@if($parMat->urlArchivo)
<td align="center"><img style="height:16px; width:16px;" src="imagenes/si.png"></td> 
<td align="center"></td>
  @else
<td align="center"></td>
  <td align="center"><img style="height:17px; weight:18px" src="imagenes/no.png"></td>
  @endif
      </tr>

@endforeach

</table>






@foreach($productoAcademicoALL as $proAca)
<table class="tabla">
 <thead>
      <tr  class="modo1">
        <th>N°</th>      
        <th> PARÁMETROS {{$proAca->nombre }}  </th>
        <th>SI</th>
        <th>NO</th>
      </tr>
    </thead>
@foreach($parametroPro as $par)

@if($par->idProAca==$proAca->id)
  <tr  class="modo1"> 
        <td> <b>*</b></td>

        <td align="left"><small style="font-size:15px;">{{ $par->nombrePar}}</small></td>



@if($par->url)
<td align="center"><img style="height:16px; width:16px;" src="imagenes/si.png"></td> 
<td align="center"></td>
  @else
<td align="center"></td>
  <td align="center"><img style="height:17px; weight:18px" src="imagenes/no.png"></td>
  @endif
      </tr>

@endif
@endforeach
</table>

@endforeach





<div class="footer">

<div id="section1" align="center" >
  _________________________________
<br>
<b>Firma Decano(a)</b>
</div> 
<br>

<div  id="section2"  align="center">
  _________________________________
  <br>
<b>Firma Coordinador(a)</b>
</div>

</body>





<!-- Numero de pg<span class="pagenum"></span>
-->
</div>
</html>