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


#section1 {
    width:350px;
    float:right;
    padding:8px;
   
}

#section2 {
     width:350px;
    float:left;
    padding:8px;
 

   
   }
      p { page-break-after: always; }
      .footer { position: fixed; bottom: 30px; }
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
	</div>



   <table class="tabla">
    <thead>
      <tr  class="modo1">
        <th>N°</th>      
        <th>PARAMETROS</th>
        <th>SI</th>
        <th>NO</th>
      </tr>
    </thead>

<!-- Cuando el docente aun no haya creado los para metros se  se les asigna a todos en x -->
      @if(count($parametros))
      <tbody>
      @php$cont=0; @endphp
@foreach($parametros as $par)
     @php$cont++; @endphp
      <tr  class="modo1"> 
        <td><b>{!! $cont !!}</b></td>

        <td align="left"><small style="font-size:15px;">{{ $par->nombrePar}}</small></td>



@if($par->url)
<td align="center"><img style="height:16px; width:17px;" src="imagenes/si.png"></td> 
<td align="center"></td>
  @else
<td align="center"></td>
  <td align="center"><img style="height:17px; weight:18px" src="imagenes/no.png"></td>
  @endif
      </tr>
@endforeach
    </tbody>
@else
<tbody>
  @php$cont2=0 @endphp

@foreach($parametro as $parame)
 @php $cont2++ @endphp
 <tr  class="modo1">
  <td align="center"><b>{!! $cont2 !!}</b></td> <td align="left" ><small style="font-size:15px;">{{ $parame->nombre}}</small></td><td></td> <td align="center"><img style="height:17px; width:18px;" src="imagenes/no.png"></td>
 </tr>
@endforeach


</tbody>

@endif

  </table>


<div class="footer" align="center">

<div id="section1" >
  _________________________________
<br>
<b>Firma Decano(a)</b>
</div> 

<div  id="section2" >
  _________________________________
<br>
<b>Firma Coordinador(a)</b>
</div>

<!-- Numero de pg<span class="pagenum"></span>
-->
</div>
</body>

</html>