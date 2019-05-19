@extends('principal')
@section('title','Potafolios Creados')
@section('content')

    <section class="container-fluid spark-screen" id="contenido_principal">


        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>CREAR PORTAFOLIO ACADÉMICO DOCENTE</label></legend>
                    </div><!-- Cierre del box header-->
                    <div class="box-body">

                        <div class="form-group text-center" id="notificacion_crear_portafolio">


                        </div><!--Cierre del div para los mensajes-->


                        <form action="crear_portafolio" class="form-horizontal form_entrada" id="frm_crear_portafolio"
                              method="post">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">

                            <div class="form-group text-center">
                                <b> <span style="font-size:18px;">PERÍODO ACADÉMICO*</span></b>
                            </div><!--Cierre del 2 group-->

                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">

                                        @if(count($periodo))
                                            <select class="form-control" id="periodo" name="periodo" required="">
                                                <option value="">
                                                    --SELECCIONE PERÍODO--
                                                </option>
                                                @foreach($periodo as $p)
                                                    <option value="{!! $p->id !!}">
                                                        {!! $p->desde !!} - {!! $p->hasta !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                        <!--Si no existe periodo academico registrado-->
                                            <select class="form-control" id="" name="" required="">
                                                <option value="">
                                                    No existe Período Académico Registrado
                                                </option>
                                            </select>

                                        @endif


                                    </div><!--Cierre del col-10-->
                                    <div class="col-md-1"></div>

                                </div><!--Cierer row-->

                            </div><!-- Cierre form graoup-->


                            <div class="form-group text-center">
                                <b> <span style="font-size:18px;">Fecha finalización*</span></b>
                            </div>

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="form-group text-center">
                                       <h4><input class="form-control" type="date" required id="fecha_fin" name="fecha_fin"></h4>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div><!--Cierre del row-->

                            <div class="form-group text-center">
                                <button class="btn btn-success" type="submit"> HABILITAR</button>
                            </div>

                        </form> <!-- Cierre del form-->


                    </div><!--Cierre box body-->

                    <br>

                    <div class="box-footer">

                    </div><!--Cierre box footer-->


                </div><!--Cierre del box-primary-->

            </div>   <!--Cierre del col-md-6-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>TIEMPO DISPONIBLE</label></legend>
                    </div><!--cERRAR BOX HEADER-->
                    <div class="box-body">
                        <div class="form-group text-center">
                            <b> <span style="font-size:18px;">PERÍODO ACADÉMICO*</span></b>
                        </div><!--Cierre del 2 group-->


                        <div class="form-group text-center">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">




                                </div><!--Cierre del col-10-->
                                <div class="col-md-1"></div>

                            </div><!--Cierer row-->

                        </div><!-- Cierre form graoup-->


                    </div><!--Cierre box body-->


                    <div class="box-footer">

                    </div><!--Cierre box footer-->

                </div><!--Cierre del segundo box primary-->
            </div>


        </div><!--Cierre del primer row-->


    </section>


    <body onload="buscarPortafolio()"></body>
@endsection
