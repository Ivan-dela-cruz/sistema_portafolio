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
                            <a title="Visualizar archivo Pdf" href="{{url($paraMat->urlArchivo)}}" target="_blank"> <img
                                        src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a>
                            <br>
                            @php

                                $date = new DateTime($paraMat->updated_at);
                                //$fecha=  $date->format('Y-m-d H:i:s');

                                $fecha=  $date->format('Y-m-d');
                                //$fecha=date("d-m-Y (H:i:s)", $date);


                            @endphp

                            <label> {{ $fecha }}</label>
                        @else
                            <a title="No existe Archivo" href="javascript:void(0);"><img
                                        src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px" ;> </a>
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

                            <a href="javascript:void(0);" onclick="eliminarArchivoParametroMat('{{$paraMat->id }}')"
                               title="Eliminar Archivo " class="btn btn-danger"><span class="fa fa-trash"></span></a>

                            <a class="btn btn-success" title="Descargar Archivo"
                               href="{{ url('descargar_pdf_Mate/'.$paraMat->id) }}""><span
                                    class="glyphicon glyphicon-save"> </span>


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
