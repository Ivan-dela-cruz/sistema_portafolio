@extends('principal')


@section('title','Parametros Asignatura')
@section('content')
<section class="content" id="contenido_principal">
	
<div class="row">

<div class="col-md-12">

<div class="box box-danger" style="height:550px">


<div class="row">
<div class="col-md-4"></div>  
<div class="col-md-4 text-center">

 <div class="form-group">
  <legend><b>Parametros </b></legend>


<div id="consolidar" class="text-center">  

<button type="button"  onclick="generar()"  target="_blank"  class="btn btn-primary btn-xs">Generar Portafolio Consolidado</button>


</div>

<input type="hidden" name="idPorMat" id="idPorMat"   value="{{$idPorMat }}">
</div>

</div>


<div class="col-md-4"></div>
</div> <!-- Cierre primer row-->



<div class="row">
  
<div class="col-md-1"></div>
<div class="col-md-10">
  



@php 
$n= count($parametrosMateria);
$cont=1;
@endphp



<table class="table" style="width: 100%;">


<tr>
@foreach($parametrosMateria as $paraMate)

<th class="text-center"> 
<div class="panel panel-info" style="">
   <div class="panel panel-warning"">
        <h4 class="modal-title"><b>{{ $paraMate->nombre }}</b> </h4>
   </div>
  
  <div class="panel-body">
  @if($paraMate->urlArchivo)
             <a  href="{{url($paraMate->urlArchivo)}}"  target="_blank"><img style="width:80px; height:100px;" src="{!! url("imagenes/pdf2.png") !!}"></a> 
  @else
  <a onclick="" href="javascript:void(0);" target="_blank"> <img style="width:80px; height:100px;"  src="{!! url("imagenes/pdf.png") !!}"></a> 
  @endif

  </div>

  
 <div class="panel-footer">
 @if(!$paraMate->urlArchivo) 
<input type="button" class="btn btn-primary btn-xs" onclick="getIdParametro('{{$paraMate->id }}', '{{ $paraMate->nombre }}')" data-toggle="modal"  data-target="#modalSubirPdf" value="Subir">
@else
<input type="button" class="btn btn-primary btn-xs" onclick="getIdParametro('{{$paraMate->id }}', '{{ $paraMate->nombre }}')" data-toggle="modal"  data-target="#modalSubirPdf" value="Actualizar">
@endif

@if($paraMate->urlArchivo)
 
 <a class="btn btn-success btn-xs" href="{{ url('descargar_pdf/'.$paraMate->id) }}">Descargar</a> 



@endif 

 
 </div>

 </div> 
</th>


<!-- Permite claificar en columnas de 4-->

@if($cont==4)
</tr><tr>
@php $cont=0; @endphp
@endif

@php 
$cont++;
@endphp
@endforeach
</tr>
</table>













</div>


<div class="col-md-1">     

    @include('Docente/modal') 
           

 </div>


</div>







</div>

</div>
</div>
</section>

@endsection