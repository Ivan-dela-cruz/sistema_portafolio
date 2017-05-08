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

		<a  href="{{ url('generar_pdf/'.base64_encode($idPorMat)) }}"  class="btn btn-info btn-xs" target="_blank" ><i class="glyphicon glyphicon-import">Generar Portafolio Consolidado</i></a>	

</div><!-- Cierre del pie panel-->

</div><!-- cierre del panel-->

</div>


</div>
</div> <!--Cierre col-md-3-->



</div><!-- Cierre primer row-->

</div><!--Cierre del body-->



<div class="box-footer "></div><!-- Cierre del pie-->

</div><!-- Cierre de la caja primary-->


<div class="box" id="rsParametro">
	
<div class="box-header text-center">
<legend><label>Listado de Parámetros</label></legend>
 </div>


@php 
$cont=0;
@endphp
                    
                        
 
                        @foreach($parametrosMateria as $paraMate)

@php$cont++ @endphp
@if($cont==1)
<div class="row from-group">
@endif
                        <div class="col-md-3 text-center form-group">     
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="modal-title">
                                        <b style="font-size:13px">
                                            {{ $paraMate->nombre }}
                                        </b>
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    @if($paraMate->urlArchivo)
        <a href="{{url($paraMate->urlArchivo)}}" title="Visualizar archivo" target="_blank"> <img src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a>
                                    @else 
          <a href="javascript:void(0);" title="No existe Archivo"><img src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px";> </a>
                                    @endif
                                
                                </div>

                                
                                <div class="panel-footer">
                                    @if(!$paraMate->urlArchivo)
                           
                                       <b> <span>
                                            No existe 
                                        </span></b>
                                   
                                    @else
                                <input type="hidden" name="Documento" id="idDocumento" value="{{$paraMate->id }}">

                  
<a href="javascript:void(0);" onclick="eliminarArchivo()" title="Eliminar Archivo " class="btn btn-danger"><span class="fa fa-trash"></span></a>
                 
            <a  class="btn btn-success"  title="Descargar Archivo" href="{{ url('descargar_pdf/'.$paraMate->id) }}"><span class="glyphicon glyphicon-save"> </span>
                                  

                                    </a>
                                  
                              
                                    @endif

                                   
                                </div>
                            </div>
         

                        </div>

@if($cont==4)
</div>
@php $cont=0 @endphp
@endif
                        @endforeach

</div><!-- Cierre de la caja box-->


	

</section>


@endsection
