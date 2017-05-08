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
                 
            <a   class="btn btn-success"  title="Descargar Archivo" href="{{ url('descargar_pdf/'.$paraMate->id) }}"><span class="glyphicon glyphicon-save"> </span>
                                  

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