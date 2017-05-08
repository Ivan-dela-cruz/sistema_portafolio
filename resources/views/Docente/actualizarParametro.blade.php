
<div class="box box-primary">

<div class="box-header text-center"><legend><label>LISTADO PARÁMETROS</label></legend>
</div><!-- Cierre del box header-->

<div class="box-body">

<div class="row">
<div class="col-md-9">

    <div class="row">
     <div class="col-md-3 text-left"> <h4><label >PERÍODO ACADÉMICO:</label></h4></div> 
     <div class="col-md-9"> <h4><span>{{ $portafolio->desde }}-{{ $portafolio->hasta }}</span></h4></div>
     </div>

     <div class="row">
     <div class="col-md-3 text-left"> <h4><label >CARRERA:</label></h4></div> 
     <div class="col-md-9"> <h4><span>{{ $portafolio->carrera }}</span></h4></div>
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
          <div class="col-md-7"><h4><span>{!! $membrete->paralelo !!}</span></h4></div>

      </div>
  </div>  
</div>


</div>

<div class="col-md-3">
    
    <div class="row">
<div class="col-md-12">

<div class="panel panel-default">
  <div class="panel-heading text-center"><b>{{ $membrete->materia }}</b></div>
  <div class="panel-body text-center">

 <img src="{{ url('imagenes/materia.png')}}">
  </div>

<div class="panel-footer text-center "  id="consolidar">

<a  href="{{ url('generar_pdf/'.base64_encode($idPorMat)) }}"  class="btn btn-info btn-xs" target="_blank" ><i class="glyphicon glyphicon-import">Generar Portafolio Consolidado</i></a>

                
</div>

</div>
               </div> <!-- Cierre del col-md-12-->
                            
    </div> <!-- Cierre del row-->

</div> <!--Cierre del col-3-->



</div> <!--Cierre de row-->

</div><!--Cierre del box Body-->




</div><!--Cierre del box Primary-->








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
        <a href="{{url($paraMate->urlArchivo)}}" target="_blank"> <img src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a>
                                    @else 
          <a href="javascript:void(0);"><img src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px";> </a>
                                    @endif
                                
                                </div>

                                
                                <div class="panel-footer">
                                    @if(!$paraMate->urlArchivo)
                                    <button class="btn btn-primary btn-xs" data-target="#modalSubirPdf" data-toggle="modal" onclick="getIdParametro('{{$paraMate->id }}', '{{ $paraMate->nombre }}')" type="button">
                                        <span class="glyphicon glyphicon-open">
                                            _Subir
                                        </span>
                                    </button>
                                    @else
                                    <button class="btn btn-success btn-xs" data-target="#modalSubirPdf" data-toggle="modal" onclick="getIdParametro('{{$paraMate->id }}', '{{ $paraMate->nombre }}')">
                                        <b class="glyphicon glyphicon-open">
                                            Modificar
                                        </b>
                                    </button>
                                    @endif

                                    @if($paraMate->urlArchivo)
                                    <a class="glyphicon glyphicon-save" href="{{ url('descargar_pdf/'.$paraMate->id) }}">Descargar
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
                    </div>
