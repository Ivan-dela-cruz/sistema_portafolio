@extends('principal')
@section('title','Parametros Portafolio')
@section('content')
    <section class="container-fluid spark-screen">


        <div class="box box-primary">
            <div class="box-header text-center">
                <legend><label>CREAR PERÍODO ACADÉMICO</label></legend>
            </div> <!--Cierre box body-->
            <div class="box-body">

                <script type="text/javascript">

                    function obtenerFechaInicio() {
                        var fecha = document.getElementById("fechaInicio").value;
                        var elem = fecha.split('-');
                        var anio = elem[0];
                        var mes = elem[1];
                        var nombreMes = "";
                        if (mes == "01") {
                            nombreMes = "Enero";
                        }
                        if (mes == "02") {
                            nombreMes = "Febrero";
                        }
                        if (mes == "03") {
                            nombreMes = "Marzo";
                        }
                        if (mes == "04") {
                            nombreMes = "Abril";
                        }
                        if (mes == "05") {
                            nombreMes = "Mayo";
                        }
                        if (mes == "06") {
                            nombreMes = "Junio";
                        }
                        if (mes == "07") {
                            nombreMes = "Julio";
                        }
                        if (mes == "08") {
                            nombreMes = "Agosto";
                        }
                        if (mes == "09") {
                            nombreMes = "Septiembre";
                        }
                        if (mes == "10") {
                            nombreMes = "Octubre";
                        }
                        if (mes == "11") {
                            nombreMes = "Noviembre";
                        }
                        if (mes == "12") {
                            nombreMes = "Diciembre";
                        }

                        document.getElementById("mes_anio_inicio").value = nombreMes + "_" + anio;
//alert(mes);
                    }


                    function obtenerFechaFin() {
                        var fecha = document.getElementById("fechaFin").value;
                        var elem = fecha.split('-');
                        var anio = elem[0];
                        var mes = elem[1];
                        var nombreMes = "";
                        if (mes == "01") {
                            nombreMes = "Enero";
                        }
                        if (mes == "02") {
                            nombreMes = "Febrero";
                        }
                        if (mes == "03") {
                            nombreMes = "Marzo";
                        }
                        if (mes == "04") {
                            nombreMes = "Abril";
                        }
                        if (mes == "05") {
                            nombreMes = "Mayo";
                        }
                        if (mes == "06") {
                            nombreMes = "Junio";
                        }
                        if (mes == "07") {
                            nombreMes = "Julio";
                        }
                        if (mes == "08") {
                            nombreMes = "Agosto";
                        }
                        if (mes == "09") {
                            nombreMes = "Septiembre";
                        }
                        if (mes == "10") {
                            nombreMes = "Octubre";
                        }
                        if (mes == "11") {
                            nombreMes = "Noviembre";
                        }
                        if (mes == "12") {
                            nombreMes = "Diciembre";
                        }

                        document.getElementById("mes_anio_fin").value = nombreMes + "_" + anio;
//alert(mes);
                    }
                </script>

                <div class="row">
                    <div class="col-md-12 text-center" id="notificacion_crear_parametro">


                    </div>

                </div>

                <form action="crear_periodo" class="form-horizontal form_entrada" id="frm_crear_periodo" method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-1"></div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4 text-left"><h4><label>Fecha Inicio<span
                                                    class="text-danger">*</span> </label></h4></div>
                                <div class="col-md-8"><h4><input required="" name="inicio" id="fechaInicio" type="month"
                                                                 onchange="obtenerFechaInicio()" class="form-control">
                                    </h4></div>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4><label>Fecha Fin<span class="text-danger">*</span> </label></h4>
                                </div>
                                <div class="col-md-8">
                                    <h4><input type="month" required="" name="fin" id="fechaFin"
                                               onchange="obtenerFechaFin()" class="form-control"></h4>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-1"></div>

                    </div><!--cierre row-->


                    <div class="row">

                        <div class="col-md-4"></div>
                        <div class="col-md-4">


                            <div class="row">
                                <div class="col-md-6">
                                    <h4><input type="hidden" readonly="" name="mes_anio_inicio" id="mes_anio_inicio"
                                               class="form-control"></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4><input type="hidden" readonly="" name="mes_anio_fin" id="mes_anio_fin"
                                               class="form-control"></h4>
                                </div>
                            </div>


                        </div>

                        <div class="col-md-4"></div>

                    </div><!--Cierre row-->


                    <div class="row">
                        <br>
                        <div class="col-md-12 text-right">

                            <a href="{{ url('/gestion_periodo') }}" class="btn btn-default">Cancelar <span
                                        class="fa fa-undo"></span></a>
                            <button type="submit" id="" class="btn btn-success"> Agregar <span
                                        class="fa fa-check-circle"></span></button>

                        </div>
                    </div><!--Cierre row-->


                </form>

            </div> <!--Cierre box body-->

            <div class="box-footer">


            </div>

        </div> <!--Cierre box primary-->


        <div class="box box-success">
            <div class="box-header text-center">
                <legend><label>Períodos Registrados</label></legend>
            </div> <!--Cierre de box success-->

            <div class="box-body text-center">
                <div class="table-responsive" id="rsPeriodoAcademicoAll">

                    @if(count($periodo))

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha Inicio</th>
                                <th class="text-center">Fecha Finalización</th>
                                <th class="text-center">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($periodo as $per)
                                <tr>

                                    <td>{{ $per->id }}</td>
                                    <td>{{ $per->desde }}</td>
                                    <td> {{ $per->hasta }}</td>

                                    <td><a href="javascript:void(0);" title="Modificar Período Académico"
                                           data-target="#modalActualizarPeriodo" data-toggle="modal"
                                           onclick="editPeriodo('{{$per->id }}', '{{ $per->desde }}','{{  $per->hasta}}')"
                                           class="btn btn-info">
                                            <span class="fa fa-pencil"></span></a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @else

                        <div class="alert alert-warning text-center">

                            <label>
                                No existen Períodos Académicos Registrados</label>
                        </div>
                @endif


                <!--  <button class="btn btn-primary" onclick="periodosCreados()" type="button">
        <span class="fa fa-eye fa-lg">
        </span>
      </button>
    -->

                </div>


            </div><!--Cierre box body-->

        </div><!--Cierre box success-->

    </section><!--cierre secction container-->
    @include('Decano/modalDecano');

@endsection

<!--
<script type="text/javascript">
  setTimeout("periodosCreados()",500);
</script>-->
