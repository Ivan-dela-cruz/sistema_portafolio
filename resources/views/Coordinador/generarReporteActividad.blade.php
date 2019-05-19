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



#section1{
  background-color:white;
  width:390px;
  height:20px;
  float:left;
  padding:5px;
  text-align: center;
  }
  
  #section2{
  background-color:white;
  width:390px;
  height:20px;
  float:right;
  padding:5px;
  text-align: center;
  }


</style>
</head>

<body>
<br>
<div   class="row">
<div  align="center" ><img  class="imagen"  src="imagenes/ciyaN.png" style="height:100px; width:790px;"></div>
</div>
<br>


<div class="row" align="center">
  <b style="font-size:17px; ">PERÍODO ACADÉMICO :</b><span style="font-size:17px;"> {{ $portafolio->desde }}-{!!$portafolio->hasta!!}</span>
  </div>

<br>
<div class="row" align="center">
  <b style="font-size:17px; ">CARRERA: </b><span style="font-size:17px;">{{$portafolio->carrera}}</span></div>
<br>


<table>
<tr>
<td colspan="4"><b style="font-size:15px;">DOCENTE: </b><span style="font-size:14px;">{{$portafolio->nombreDoc}} {{$portafolio->apellidoDoc}}</span></td>
</tr>
</table>
<br>
	<div align="center">
		<b style="font-size:18px;">REPORTE ACTIVIDADES DOCENCIA</b>
	<br><br>
  </div>




@foreach($categoria as $cate)
<table class="tabla">
 <thead>
      <tr  class="modo1">
        <th>N°</th>      
        <th> ACTIVIDAD {{$cate->nombre }}  </th>
        <th>SI</th>
        <th>NO</th>
      </tr>
    </thead>
@foreach($actividad as $acti)

@if($acti->idCat==$cate->id)
  <tr  class="modo1"> 
        <td> <b>*</b></td>

        <td align="left" width="500px" ><small style="font-size:15px;">{{ $acti->nombre}}</small></td>



@if($acti->urlArchivo)
<td align="center"><img style="height:16px; width:16px;" src="imagenes/si.png"></td> 
<td align="center"></td>
  @else
<td align="center"></td>
  <td align="center"  ><img style="height:17px; weight:18px" src="imagenes/no.png"></td>
  @endif
      </tr>

@endif
@endforeach
</table>

@endforeach





<br><br>

<br><br>

<div id="section1">
 --------------------------------
<br>
<b>Firma Director(a)</b>
</div>  

<div id="section2">
 ---------------------------------
  <br>
<b>Firma Decano(a)</b>
</div>




</body>


</html>