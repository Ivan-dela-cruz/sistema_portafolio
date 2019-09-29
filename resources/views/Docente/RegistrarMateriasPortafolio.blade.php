@extends('principal')
@section('title','Asignaturas Portafolio')
@section('content')
    <section class="container-fluid spark-screen" id="contenido_principal">
        <div class="row">
            <div class="col-md-12">
                <div id="notificacion">
                    @if($message = Session::get('succes'))
                        <div class="alert alert-success">
                            <p>{{$message}}</p>

                        </div>

                    @endif
                    @if($message = Session::get('error'))
                        <div class="alert alert-error">
                            <p>{{$message}}</p>

                        </div>

                    @endif
                </div>
            </div>
        </div>
        <form action="agregar_nueva_materia_portafolio" class="form-form" id="frm_agregar_materia"
              method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="col-md-10">

                <div class="box box-primary">

                    <div class="box-header text-center">
                        <legend><label>REGISTRO DE ASIGNATURAS</label></legend>
                    </div><!--Cierre box header-->

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">CARRERA*</span></b>
                            </div><!---->
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group text-center">
                                    @if(count($carrera))
                                        <select class="form-control" id="selecCarrera" name="selecCarrera"
                                                onchange="ShowSelectedCarrera();" required="">
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
                                    <input hidden type="text" id="idCarrera" name="idCarrera">
                                </div>
                            </div>

                        </div><!--Cierre row-->

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">CICLO*</span></b>
                            </div><!---->
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group text-center">
                                    <select class="form-control" id="selectCiclo" name="selectCiclo"
                                            onchange="ShowSelectedCiclo();" required="">
                                        <option value="">
                                            --Seleccione Ciclo--
                                        </option>
                                        <option value="1">
                                            PRIMERO
                                        </option>
                                        <option value="2">
                                            SEGUNDO
                                        </option>
                                        <option value="3">
                                            TERCERO
                                        </option>
                                        <option value="4">
                                            CUARTO
                                        </option>
                                        <option value="5">
                                            QUINTO
                                        </option>
                                        <option value="6">
                                            SEXTO
                                        </option>
                                        <option value="7">
                                            SÉPTIMO
                                        </option>
                                        <option value="8">
                                            OCTAVO
                                        </option>
                                        <option value="9">
                                            NOVENO
                                        </option>
                                        <option value="10">
                                            DÉCIMO
                                        </option>
                                    </select>
                                </div>
                                <input hidden type="text" id="idCiclos" name="idCiclos">

                            </div>

                        </div><!--Cierre row-->


                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">NOMBRE*</span></b>
                            </div><!---->
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group text-center">
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>

                            </div>

                        </div><!--CIERRE ROW-->

                        <div class="row form-group">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3 text-right">
                                <button class="btn btn-success btn-lg btn-block" type="submit">
                                    Agregar Asignatura
                                </button>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div><!--cierra ultimo-->


                    </div><!--Cierre box body-->


                </div><!--CIERRE DEL BOX PRIMARY-->
            </div>

        </form><!--CIERRE DEL FORM-->

        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header text-center">
                    <legend><label>Asignaturas</label></legend>
                </div><!--cERRAR BOX HEADER-->
                <div class="box-body">

                    <div class="form-group text-center">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <table class="table">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th scope="col">COD</th>
                                        <th class="text-center" scope="col">CARRERA</th>
                                        <th class="text-center" scope="col">CICLO</th>
                                        <th class="text-center" scope="col">NOMBRE</th>

                                        <th scope="col">ACCIONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if(count($materias))

                                        @foreach($materias as $materia)
                                            <tr>
                                                <td>{!! $materia->id !!}</td>
                                                <td>{!! strtoupper($materia->carrera)!!}</td>
                                                <td>{!! strtoupper($materia->ciclo)!!}</td>
                                                <td class="text-left">{!!strtoupper( $materia->nombre)!!}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning"
                                                       href="{{ url('modificar_materia/'.$materia->id) }}">
                                                        Editar →
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach


                                    @else
                                        <!--Si no existe periodo academico registrado-->

                                        <h4 value="">
                                            No existe Período Académico Registrado
                                        </h4>


                                    @endif
                                    {{$materias->render()}}
                                    </tbody>
                                </table>

                            </div><!--Cierre del col-10-->
                            <div class="col-md-1"></div>

                        </div><!--Cierer row-->

                    </div><!-- Cierre form graoup-->


                </div><!--Cierre box body-->


                <div class="box-footer">

                </div><!--Cierre box footer-->

            </div><!--Cierre del segundo box primary-->
        </div>


    </section>
    <body>
    </body>
@endsection
@section('javascript')
    <script type="text/javascript">
        function ShowSelectedCarrera() {
            /* Para obtener el valor */
            var cod = document.getElementById("selecCarrera").value;

            document.getElementById("idCarrera").value = cod;


        }

        function ShowSelectedCiclo() {
            /* Para obtener el valor */
            var cod = document.getElementById("selectCiclo").value;

            document.getElementById("idCiclos").value = cod;


        }
    </script>
@endsection


<!--<script type="text/javascript">
    setTimeout("materiasCreadas()",500);
</script>-->


<!-- Incluye el modal para subir los parametros de los portafolio-->
@include('Docente/modalParametroPortafolio')