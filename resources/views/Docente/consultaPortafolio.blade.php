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
                                <b> <span style="font-size:18px;">CARRERA*</span></b>
                            </div><!---->


                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="form-group text-center">
                                        @if(count($carrera))
                                            <select class="form-control" id="carrera" name="carrera"
                                                    onchange="asignarNombrePortafolio(this.value)" required="">
                                                <option value="">
                                                    --SELECCIONE CARRERA--
                                                </option>
                                                @foreach($carrera as $car)
                                                    <option value="{!! $car->id !!}">
                                                        {!! $car->nombre!!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="form-control" id="" name="" required="">
                                                <option value="">
                                                    No existen Carreras Registrada
                                                </option>
                                            </select>




                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-1"></div>


                            </div><!--Cierre row-->


                            <div class="form-group text-center">
                                <b> <span style="font-size:18px;">NOMBRE PORTAFOLIO*</span></b>
                            </div>

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="form-group text-center">
                                        <input class="form-control" id="nombrePortafolio" name="nombrePortafolio"
                                               readonly="" required="" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div><!--Cierre del row-->

                            <div class="form-group text-center">
                                <button class="btn btn-success" type="submit"> CREAR PORTAFOLIO</button>
                            </div>

                        </form> <!-- Cierre del form-->

                        <script type="text/javascript">

                            function asignarNombrePortafolio(valor) {
                                var carrera = "";
                                if (valor == 1)
                                    carrera = "PORTAFOLIO DE ING. ELÉCTRICA";
                                if (valor == 2)
                                    carrera = "PORTAFOLIO DE ING. INDUSTRIAL";
                                if (valor == 3)
                                    carrera = "PORTAFOLIO DE ING. ELECTROMECÁNICA"
                                if (valor == 4)
                                    carrera = "PORTAFOLIO DE ING. SISTEMAS";
                                document.getElementById("nombrePortafolio").value = carrera;
                            }
                        </script>


                    </div><!--Cierre box body-->

                    <br>

                    <div class="box-footer">

                    </div><!--Cierre box footer-->


                </div><!--Cierre del box-primary-->

            </div>   <!--Cierre del col-md-6-->


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>VISUALIZAR PORTAFOLIO ACADÉMICO DOCENTE</label></legend>
                    </div><!--cERRAR BOX HEADER-->
                    <div class="box-body">
                        <div class="form-group text-center">
                            <b> <span style="font-size:18px;">PERÍODO ACADÉMICO*</span></b>
                        </div><!--Cierre del 2 group-->


                        <div class="form-group text-center">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">

                                    <!--Verificar que exista al menos un periodo Academico Registrado-->
                                    @if(count($periodo))
                                        <select class="form-control" id="periodoBuscar" name="periodo"
                                                onchange="buscarPortafolio()" required="">
                                        <!--    <option value="{{ base64_encode('0')}}">
                                SELECCIONE PERÍODO
                            </option>-->
                                            @foreach($periodo as $per)
                                                <option value="{!!base64_encode($per->id)!!}">
                                                    {!! $per->desde!!} - {!! $per->hasta!!}
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


                    </div><!--Cierre box body-->


                    <div class="box-footer">

                    </div><!--Cierre box footer-->

                </div><!--Cierre del segundo box primary-->


                <div class="box box-info">

                    <div class="box-header text-center">
                        <label>PORTAFOLIOS ACADÉMICOS REGISTRADOS</label>
                    </div>

                    <div class="box-body" id="rsPortafolio">


                    </div>
                    <div class="box-footer"></div>
                </div>

            </div> <!--Cierre del col-md-6-->


        </div><!--Cierre del primer row-->


    </section>

    <body onload="buscarPortafolio()"></body>
@endsection
