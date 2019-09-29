<div class="box box-primary">

    <div class="box-header text-center">
        <legend><label>LISTADO DE PARÁMETROS ASIGNATURA</label></legend>
    </div><!-- Cierre del box header-->

    <div class="box-body">

        <div class="row">
            <div class="col-md-9">

                <div class="row">
                    <div class="col-md-3 text-left"><h4><label>PERÍODO ACADÉMICO:</label></h4></div>
                    <div class="col-md-9"><h4><span>{{ $portafolio->desde }}-{{ $portafolio->hasta }}</span></h4></div>
                </div>

                <div class="row">
                    <div class="col-md-3 text-left"><h4><label>CARRERA:</label></h4></div>
                    <div class="col-md-9"><h4><span>{{ $portafolio->carrera }}</span></h4></div>
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
                            <div class="col-md-5 text-left"><h4><label>PARALELO:</label></h4></div>
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

                                <img src="{{ asset('imagenes/materia.png')}}">
                            </div>

                            <div class="panel-footer text-center " id="consolidar">


                                <a href="{{ url('generar_pdf/'.base64_encode($idPorMat)) }}"
                                   class="btn btn-success btn-xs" target="_blank">Generar el Portafolio Consolidado</a>


                            </div>

                        </div>
                    </div> <!-- Cierre del col-md-12-->

                </div> <!-- Cierre del row-->

            </div> <!--Cierre del col-3-->


        </div> <!--Cierre de row-->

    </div><!--Cierre del box Body-->

    <div class="box-footer">

    </div><!-- Cierre box pie-->


</div><!--Cierre del box Primary-->


<div class="box box-success text-center">
    <div class="box-header">
        <legend><label>PARÁMETROS ASIGNATURA</label></legend>
    </div>
    <div id="seccion-portada" class="box-body">
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
                                                src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px" ;>
                                    </a>
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

    </div> <!--Cierre box body-->


</div>


<div id="seccion-asignaturas" class="box box-info">

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
                                        <a href="{{url($paraProduc->urlArchivo)}}" title="Visualizar archivo Pdf"
                                           target="_blank"> <img src="{{url('imagenes/pdf2.png')}}"
                                                                 style="width:50px; height:50px;"></a>
                                    @else
                                        <a href="javascript:void(0);" title="No existe archivo Pdf"><img
                                                    src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px"
                                                    ;> </a>
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


</div><!--cierre del box sucess -->

