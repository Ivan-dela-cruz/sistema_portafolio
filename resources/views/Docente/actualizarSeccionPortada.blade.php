

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
                                    {{ $paraMat->nombre }}
                                </b>
                            </h4>
                        </div>
                        <div class="panel-body">
                            @if($paraMat->urlArchivo)
                                <a href="{{url($paraMat->urlArchivo)}}" title="Visualizar archivo Pdf"
                                   target="_blank"> <img src="{{url('imagenes/pdf2.png')}}"
                                                         style="width:50px; height:50px;"></a>
                            @else
                                <a href="javascript:void(0);" title="No existe archivo Pdf"><img
                                            src="{{ url('imagenes/pdf.png')}}"
                                            style="width:45px; height:55px" ;> </a>
                            @endif

                        </div>


                        <div class="panel-footer">
                            @if(!$paraMat->urlArchivo)
                                <button class="btn btn-primary btn-xs" data-target="#modalSubirParametroMat"
                                        data-toggle="modal"
                                        onclick="getIdParametro2('{{$paraMat->id }}', '{{ $paraMat->nombre }}')"
                                        type="button">
                                        <span class="glyphicon glyphicon-open">
                                            _Subir
                                        </span>
                                </button>
                            @else

                            <!--  <button class="btn btn-success btn-xs" data-target="#modalSubirParametroMat" data-toggle="modal" onclick="getIdParametro2('{{$paraMat->id }}', '{{ $paraMat->nombre }}')">
                                        <b class="glyphicon glyphicon-open">
                                            Modificar
                                        </b>
                                    </button> -->

                            @endif

                            @if($paraMat->urlArchivo)
                                @if($tiempoTares->fecha_fin_materia >= $hoy->toDateString() && $tiempoTares->hora_fin_materia >= $hoy->toTimeString())
                                    <a href="javascript:void(0);"
                                       onclick="eliminarArchivoParametroAsignatura('{{$paraMat->id }}')"
                                       title="Eliminar Archivo "
                                       class="glyphicon glyphicon-trash">Eliminar</a>
                                @endif
                                &nbsp&nbsp&nbsp&nbsp
                                <a class="glyphicon glyphicon-save"
                                   href="{{ url('descargar_pdf_Mate/'.$paraMat->id) }}">Descargar
                                </a>
                            @endif
                        </div>
                    </div>


                </div>

                @if($cont2==4)
            </div>
            @php $cont2=0 @endphp
        @endif

    @endforeach

