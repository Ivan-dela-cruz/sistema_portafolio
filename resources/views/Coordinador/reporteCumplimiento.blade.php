@extends('principal')
@section('title','Reporte Cumplimiento')

@section('content')

    <section class="container-fluid spark-screen" id="contenido_principal">

        <div class="box box-primary">
            <div class="box-header text-center">
                <legend><label>REPORTE VERIFICACIÓN</label></legend>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-md-3 text-left"><h4><label>PERÍODO ACADÉMICO:</label></h4></div>
                            <div class="col-md-9"><h4><span>{{$portafolio->desde }}-{{ $portafolio->hasta }}</span></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 text-left"><h4><label>CARRERA:</label></h4></div>
                            <div class="col-md-9"><h4><span>{{ $portafolio->carrera }}</span></h4></div>
                        </div>


                        <div class="row">
                            <div class="col-md-3 text-left"><h4><label>DOCENTE:</label></h4></div>
                            <div class="col-md-9"><h4>
                                    <span>{{ $portafolio->nombreDoc}} {{$portafolio->apellidoDoc  }}</span></h4></div>
                        </div>

                    </div>


                    <div class="col-md-3">

                        <div class=" panel panel-primary">
                            <div class="panel-heading text-center"><b
                                        style="font-size:14px">{{ $portafolio->portafolio}}</b></div>
                            <div class="panel-body text-center"><img style="height:70px; width:80px;"
                                                                     src="{{ url('imagenes/Portafolios.png') }}"></div>
                        </div>

                    </div>


                </div>


            </div><!--cerrar el box body-->

        </div>


        <div class="box box-success">

            <div class="box-header text-center">
                <label>PORTADA GENERAL</label>
            </div>  <!--cierre del box header-->

            <div class="box-body" id="rsParametroPorta">

                <table class="table" class="text-center">
                    <thead>
                    <tr>

                        <th class="text-center">PARÁMETROS</th>
                        <th class="text-center">ACCIÓN</th>
                    </tr>

                    </thead>

                    @foreach($parametroPortafolio as $paraPorta)
                        <tr>
                            <td class="text-center"><br> <b style="font-size:13px"> {{ $paraPorta->parametro }} </b>
                            </td>
                            @if($paraPorta->urlArchivo)





                                <td class="text-center">
                                    <a title="Visualizar archivo Pdf" href="{{url($paraPorta->urlArchivo)}}"
                                       target="_blank"> <img src="{{url('imagenes/pdf2.png')}}"
                                                             style="width:50px; height:50px;"></a>
                                    <br>
                                    @php

                                        $date = new DateTime($paraPorta->updated_at);
                                        //$fecha=  $date->format('Y-m-d H:i:s');

                                        $fecha=  $date->format('Y-m-d');
                                        //$fecha=date("d-m-Y (H:i:s)", $date);


                                    @endphp

                                    <label> {{ $fecha }}</label> <br>
                                    <a href="javascript:void(0);"
                                       onclick="eliminarArchivoParametroPorta('{{$paraPorta->id }}')"
                                       title="Eliminar Archivo " class="btn btn-danger"><span
                                                class="fa fa-trash"></span></a>

                                    <a class="btn btn-success" title="Descargar Archivo"
                                       href="{{ url('descargar_pdf_Porta/'.$paraPorta->id) }}"><span
                                            class="glyphicon glyphicon-save"> </span></a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a title="No existe Archivo" href="javascript:void(0);"><img
                                                src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px" ;>
                                    </a>
                                    <br>
                                    <b> <span>
                                            No existe 
                                        </span></b>

                                </td>
                            @endif

                        </tr>
                    @endforeach

                </table>


            </div> <!--Cierre box body-->


        </div> <!-- Cierre del box succes-->


        <div class="box box-info">
            <div class="box-header text-center">
                <label>ASIGNATURAS REGISTRADAS</label>

            </div>


            <div class="box-body">

                @if(count($materias))

                    @foreach($materias as $mat)
                        <div class="col-md-3 text-center">

                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">{{ $mat->ciclo}} '{{$mat->paralelo}}'</div>
                                <div class="panel-body text-center"><img src="{{url('imagenes/materia.png')}}"
                                                                         style="width:50px; height:50px;"></div>
                                <div class="panel-body text-center"><b style="font-size:11px">{{ $mat->materia}}</b>
                                </div>


                                <div class="panel-footer text-center">

                                    <a style="color: blue"
                                       href="{{ url('reporte_verificacion/'.$portafolio->idPorta.'/'.$mat->idPorMat) }}">Reporte
                                        Verificación</a>

                                    <br><br>
                                    <a style="color: blue"
                                       href="{{url('generar_reporte_cumplimiento/'.$portafolio->idPorta. '/'.$mat->idPorMat)}}"
                                       target="_blank"> Generar Reporte Cumplimiento </a></div>
                            </div>


                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning text-center"><label>Docente hasta el monento no registra asignaturas
                            en su portafolio académico </label></div>
                @endif


            </div> <!--Cierre box body-->


        </div> <!--Cierre box suceess-->


    </section>

@endsection