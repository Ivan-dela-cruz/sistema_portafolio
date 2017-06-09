@extends('principal')
@section('title','Reporte Cumplimiento')
@section("content")

<section class="content">
<div class="box box-primary">
	<div class="box-header text-center">
		<legend><label>REPORTE VERIFICACIÓN</label></legend>
	</div><!-- cierre del box header-->
<div class="box-body">

<div class="row">
<div class="col-md-9">
<div class="row">
	<div class="col-md-3 text-left"><h4><label>PERÍODO ACADÉMICO:</label></h4></div>
	<div class="col-md-9"><h4><span>{{ $portafolio->desde}}-{{ $portafolio->hasta }}</span></h4></div>
</div>
<div class="row">
	<div class="col-md-3 text-left"><h4><label>CARRERA:</label></h4></div>
	<div class="col-md-9"><h4><span>{{$portafolio->carrera}}</span></h4></div>

</div>

<div class="row">
	<div class="col-md-3 text-left"><h4><label>DOCENTE:</label></h4></div>
	<div class="col-md-9"><h4><span>{{$portafolio->nombreDoc}} {{$portafolio->apellidoDoc }}</span></h4></div>

</div>


<div class="row">
  <div class="col-md-7"> 
  <div class="row">
      <div class="col-md-5 text-left"><h4><label>CICLO:</label></h4></div>
      <div class="col-md-7"><h4><span>{{ $membrete->ciclo }}</span></h4></div>

  </div>
  </div>
  <div class="col-md-5">
      <div class="row">
          <div class="col-md-5 text-left"> <h4><label>PARALELO:</label></h4></div>
          <div class="col-md-7"><h4><span>{{$membrete->paralelo  }}</span></h4></div>

      </div>
  </div>  
</div>


</div><!--cierre col-md9-->



<div class="col-md-3"> 


<div class="row">

<div class="col-md-12"> 
<div class="panel panel-default">
	<div class="panel-heading text-center"><b>{{ $membrete->materia }}</b></div>
    <div class="panel-body text-center">
    	<img src="{{url('imagenes/reporte.png')}}">

    </div> <!--cierre panel body-->

  <div class="panel-footer text-center" id="consolidar">

		<a  href="{{ url('generar_pdf/'.base64_encode($idPorMat)) }}"  class="btn btn-info btn-xs" target="_blank" >Generar el Portafolio Consolidado</a>	

</div><!-- Cierre del pie panel-->

</div><!-- cierre del panel-->

</div>


</div>
</div> <!--Cierre col-md-3-->



</div><!-- Cierre primer row-->

</div><!--Cierre del body-->



<div class="box-footer "></div><!-- Cierre del pie-->

</div><!-- Cierre de la caja primary-->






<div class="box box-success" id="rsParametroMat">
<div class="box-header text-center">
  
  <legend><label>PARÁMETROS ASIGNATURA</label></legend>
</div>  



@php 
$cont2=0;
@endphp
  @foreach($parametrosMateria as $paraMat)
@php$cont2++ @endphp
@if($cont2==1)
<div class="row from-group">
@endif
                        <div class="col-md-3 text-center form-group">     
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="modal-title">
                                        <b style="font-size:13px">
                                            {{ $paraMat->parametro }}
                                        </b>
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    @if($paraMat->urlArchivo)
        <a  title="Visualizar archivo Pdf" href="{{url($paraMat->urlArchivo)}}" target="_blank"> <img src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a>
<br>
    @php

$date = new DateTime($paraMat->updated_at);
//$fecha=  $date->format('Y-m-d H:i:s');

$fecha=  $date->format('Y-m-d');
//$fecha=date("d-m-Y (H:i:s)", $date);


     @endphp

      <label> {{ $fecha }}</label> 
                                    @else 
          <a title="No existe Archivo" href="javascript:void(0);"><img src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px";> </a>
                                    @endif
                                
                                </div>

                                
                                <div class="panel-footer">
                                    @if(!$paraMat->urlArchivo)
                                   
                                         <b> <span>
                                            No existe 
                                        </span></b>
                                    @else
                                    
                                   <!-- <button class="btn btn-success btn-xs" data-target="#modalSubirParametroPorta" data-toggle="modal" onclick="getIdParametro3('{{$paraMat->id }}', '{{ $paraMat->parametro }}')">
                                        <b class="glyphicon glyphicon-open">
                                            Modificar
                                        </b>
                                    </button>-->

                                    @endif

                                    @if($paraMat->urlArchivo)
                                              
<a href="javascript:void(0);" onclick="eliminarArchivoParametroMat('{{$paraMat->id }}')" title="Eliminar Archivo " class="btn btn-danger"><span class="fa fa-trash"></span></a>
                 
            <a  class="btn btn-success"  title="Descargar Archivo" href="{{ url('descargar_pdf_Mate/'.$paraMat->id) }}""><span class="glyphicon glyphicon-save"> </span>
                                  

                                    </a></a>
                                    


                                    @endif
                                </div>
                            </div>
         

                        </div>

@if($cont2==4)
</div>
@php $cont2=0 @endphp
@endif

  @endforeach


<!--Para cerrar el row cunado sea menos de 4-->
@if($cont2!=0)
</div>
@endif

</div><!-- Cierre del box success-->










<div class="box box-info" id="rsParametro">


@foreach($productosAcademico as $prodAca)

<div class="box-header text-center">
 <legend><label><b> PARÁMETROS {{ $prodAca->nombre }}</b> </label></legend>
</div>

<div class="box-body">


@php 
$cont=0;
@endphp
                    
                        
 
                        @foreach($parametrosProducto as $paraProd)

@if($prodAca->id==$paraProd->idProAca)

@php$cont++ @endphp
@if($cont==1)
<div class="row from-group">
@endif
                        <div class="col-md-3 text-center form-group">     
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="modal-title">
                                        <b style="font-size:13px">
                                            {{ $paraProd->nombre }}
                                        </b>
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    @if($paraProd->urlArchivo)
        <a href="{{url($paraProd->urlArchivo)}}" title="Visualizar archivo" target="_blank"> <img src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a>

<br>
    @php

$date2 = new DateTime($paraProd->updated_at);
//$fecha=  $date->format('Y-m-d H:i:s');

$fecha2=  $date2->format('Y-m-d');
//$fecha=date("d-m-Y (H:i:s)", $date);


     @endphp

      <label> {{ $fecha2 }}</label> 



                                    @else 
          <a href="javascript:void(0);" title="No existe Archivo"><img src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px";> </a>
                                    @endif
                                
                                </div>

                                
                                <div class="panel-footer">
                                    @if(!$paraProd->urlArchivo)
                           
                                       <b> <span>
                                            No existe 
                                        </span></b>
                                   
                                    @else
                            

                  
<a href="javascript:void(0);" onclick="eliminarArchivo('{{$paraProd->id }}')" title="Eliminar Archivo " class="btn btn-danger"><span class="fa fa-trash"></span></a>
                 
            <a  class="btn btn-success"  title="Descargar Archivo" href="{{ url('descargar_pdf/'.$paraProd->id) }}"><span class="glyphicon glyphicon-save"> </span>
                                  

                                    </a>
                                  
                              
                                    @endif

                                   
                                </div>
                            </div>
         

                        </div>

@if($cont==4)
</div>
@php $cont=0 @endphp
@endif

@endif

                        @endforeach

</div> <!--Cierre caja body-->


@endforeach


</div><!-- Cierre de la caja box-->


	

</section>


@endsection
