@foreach($productosAll as $proAll)
    <div class="box-header text-center">
        <legend><label><b> PARÁMETROS {{ $proAll->nombre }}</b> </label></legend>
    </div>
    <div class="box-body">
    @php
        $cont=0;
    @endphp
    @foreach($parametrosProducto as $paraProduc)

        @if($proAll->id==$paraProduc->idProAca)<!--Para clasificar pro productos academicos-->

            @php$cont++ @endphp
            @if($cont==1)
                <div class="row from-group">
                    @endif
                    <div class="col-md-3 text-center form-group">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="modal-title">
                                    <b style="font-size:13px">
                                        {{ $paraProduc->nombre }}
                                    </b>
                                </h4>
                            </div>
                            <div class="panel-body">
                                @if($paraProduc->urlArchivo)
                                    <a href="{{url($paraProduc->urlArchivo)}}"
                                       title="Visualizar archivo Pdf" target="_blank"> <img
                                                src="{{url('imagenes/pdf2.png')}}"
                                                style="width:50px; height:50px;"></a>
                                @else
                                    <a href="javascript:void(0);" title="No existe archivo Pdf"><img
                                                src="{{ url('imagenes/pdf.png')}}"
                                                style="width:45px; height:55px" ;> </a>
                                @endif

                            </div>


                            <div class="panel-footer">
                                @if(!$paraProduc->urlArchivo)
                                    <button class="btn btn-primary btn-xs" data-target="#modalSubirPdf"
                                            data-toggle="modal"
                                            onclick="getIdParametro('{{$paraProduc->id }}', '{{ $paraProduc->nombre }}')"
                                            type="button">
                                                    <span class="glyphicon glyphicon-open">
                                                        _Subir
                                                    </span>
                                    </button>
                                @else
                                <!--
                                    <button class="btn btn-success btn-xs" data-target="#modalSubirPdf" data-toggle="modal" onclick="getIdParametro('{{$paraProduc->id }}', '{{ $paraProduc->nombre }}')">
                                        <b class="glyphicon glyphicon-open">
                                            Modificar
                                        </b>
                                    </button> -->
                                @endif

                                @if($paraProduc->urlArchivo)
                                    @if($tiempoTares->fecha_fin_materia >= $hoy->toDateString() && $tiempoTares->hora_fin_materia >= $hoy->toTimeString())
                                        <a href="javascript:void(0);"
                                           onclick="eliminarArchivoProducto('{{$paraProduc->id }}')"
                                           title="Eliminar Archivo "
                                           class="glyphicon glyphicon-trash">Eliminar</a>
                                    @endif
                                    &nbsp&nbsp&nbsp&nbsp
                                    <a class="glyphicon glyphicon-save"
                                       href="{{ url('descargar_pdf/'.$paraProduc->id) }}">Descargar
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
    @endforeach <!--Cierre del segundo foreach-->


    </div> <!--Cierre del box body-->

@endforeach<!-- Cierre del primer foreach-->