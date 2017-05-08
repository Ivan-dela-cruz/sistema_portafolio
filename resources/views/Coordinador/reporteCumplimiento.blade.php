@extends('principal')
@section('title','Reporte Cumplimiento')

@section('content')

<section class="container-fluid spark-screen"  id="contenido_principal">

<div class="box box-success">
  <div class="box-header text-center"><legend><label>REPORTES</label></legend> </div>
<div class="box-body">
  
<div class="row">
<div class="col-md-9">  

<div class="row">
     <div class="col-md-3 text-left"> <h4><label>PERÍODO ACADÉMICO:</label></h4></div> 
     <div class="col-md-9"><h4><span>{{$portafolio->desde }}-{{ $portafolio->hasta }}</span></h4></div>
     </div>

     <div class="row">
     <div class="col-md-3 text-left"> <h4><label >CARRERA:</label></h4></div> 
     <div class="col-md-9"> <h4><span>{{ $portafolio->carrera }}</span></h4></div>
     </div>



     <div class="row">
     <div class="col-md-3 text-left"> <h4><label >DOCENTE:</label></h4></div> 
     <div class="col-md-9"> <h4><span>{{ $portafolio->nombreDoc}} {{$portafolio->apellidoDoc  }}</span></h4></div>
     </div>



</div>




<div class="col-md-3">

    <div class=" panel panel-primary">
      <div class="panel-heading text-center"><b style="font-size:14px">{{ $portafolio->portafolio}}</b></div>
      <div class="panel-body text-center"> <img style="height:70px; width:80px;" src="{{ url('imagenes/Portafolios.png') }}">  </div>
    </div>
  
</div>


</div>




</div><!--cerrar el box body-->

</div>













<div class="row text-center">

@if(count($materias))

@foreach($materias as $mat)
<div class="col-md-3 text-center">

<div class="panel panel-primary" >
  <div class="panel-heading text-center">{{ $mat->ciclo}} '{{$mat->paralelo}}'</div>
  <div class="panel-body text-center"><img src="{{url('imagenes/materia.png')}}" style="width:50px; height:50px;"></div>
  <div class="panel-body text-center"><b style="font-size:11px">{{ $mat->materia}}</b></div>

<input type="text" value="{{ $portafolio->idPorta }} idPortafolio" name="">
<input type="text"  value="{{ $mat->idPorMat }} idPormat" name="">
  <div class="panel-footer text-center" > 
  
<a href="{{ url('reporte_verificacion/'.$portafolio->idPorta.'/'.$mat->idPorMat) }}">Verificar_<i class="glyphicon glyphicon-eye-open"> </i>_Reporte</a>

  <br><br>
  <a href="{{url('generar_reporte_cumplimiento/'.$portafolio->idPorta. '/'.$mat->idPorMat)}}" target="_blank"> Generar Reporte Cumplimiento </a></div>
</div> 


</div>
@endforeach
@else
<div class="alert alert-warning text-center"><label>Docente hasta el monento no registra asignaturas en su portafolio académico </label></div>
@endif




</div>



</section>

@endsection