@extends('principal')
@section('title','Reporte Cumplimiento')

@section('content')

<section class="content"  id="contenido_principal">

<div class="row">
<div class="col-md-1"> 

</div>
<div class="col-md-5">	
        <legend style="font-size:18px"><b >Período Académico : </b> <span> {{ $portafolio->desde }}-{!!$portafolio->hasta!!}</span></legend>        
        <legend style="font-size:18px"><b> Docente: </b><span>{{ $portafolio->nombreDoc}} {{$portafolio->apellidoDoc  }}</span> </legend>
        <legend style="font-size:18px"><b>Carrera: </b> <span>{{ $portafolio->carrera}}</span></legend>

</div>
<div class="col-md-1"></div>



<div class="col-md-4">

<div class=" panel panel-primary">
      <div class="panel-heading text-center"><b style="font-size:14px">{{ $portafolio->portafolio}}</b></div>
      <div class="panel-body text-center"> <img style="height:70px; width:80px; " src="{{ url('imagenes/Portafolios.png') }}">  </div>
    </div>
	

</div>

<div class="col-md-1"></div>
</div>

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10 text-center">
	
<legend><b>REPORTE CUMPLIMIENTO</b></legend>

</div>
<div class="col-md-1"></div>
</div>

<div class="row text-center">

<div class="col-md-12 text-center">
@php $cont=0;@endphp

<table class="table text-center" >
<tr class="text-center">
@foreach($materias as $mat)
<th>  <div class="panel panel-primary" style="width:257px">
  <div class="panel-heading text-center">{{ $mat->ciclo}} '{{$mat->paralelo}}'</div>

  <div class="panel-body text-center"><img style="height:50px; width:50px; " src="{{ url('imagenes/materia.png') }}"> </div>
  <div class="panel-body text-center"><b style="font-size:11px">{{ $mat->materia}}</b></div>
<input type="text" value="{{ $portafolio->idPorta }}" name="">

  <div class="panel-footer text-center" > <a href="{{url('generar_reporte_cumplimiento/'.$portafolio->idPorta. '/'.$mat->idPorMat)}}" target="_blank"  >Generar</a> </div></div> </th>
@php 
$cont++;
@endphp
@if($cont==4)
@php $cont=0; @endphp
</tr><tr>
@endif
@endforeach

</table>

</div>



</div>



</section>

@endsection