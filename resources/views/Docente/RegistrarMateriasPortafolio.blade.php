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
                                <div id="notificacion-delete"></div>
                                <form method="GET" action="crear_materia" role="search">
                                    <div class="input-group">

                                        <select class="form-control input-lg"
                                                name="selecCarrera" id="selecCarrera">
                                            <option>CARRERA</option>
                                            @foreach($carrera as $car)
                                                <option
                                                        @if ($car->id==$selecCarrera)
                                                        selected
                                                        @endif
                                                        value="{!! $car->id !!}">
                                                    {!! $car->nombre!!}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                             <select style="width: 130px;" class="form-control input-lg"
                                                     name="selecCiclo" id="selecCiclo">
                                                <option value="">CICLO</option>
                                                 @foreach($ciclos as $ciclo)

                                                     <option
                                                             @if ($ciclo->id==$selecCiclo)
                                                             selected
                                                             @endif

                                                             value="{{$ciclo->id}}">
                                                   {{$ciclo->nombre}}
                                                </option>
                                                 @endforeach
                                             </select>
                                          </span>
                                        <span class="input-group-btn">
                                                <input class="btn btn-primary btn-lg" value="Buscar" type="submit"/>
                                          </span>
                                    </div>
                                </form>


                                <div id="id-tab-mat">
                                    @include('Docente.tablaMaterias')
                                </div>

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

        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            ///url = pagina-materias
            var pathname = window.location.search;
            if (pathname != '') {
                // alert(pathname);
                var url = '/pagina-materias' + pathname + '&page=';
                fetch_data(page, url);
            }
            else {
                // alert('vacio');
                var url = '/pagina-materias?page=';
                fetch_data(page, url);
            }
        });

        function fetch_data(page, url) {
            var url = url + page;
            $.get(url, function (result) {
                $(".id-tab").remove();
                $(".btn-delete").removeData('id-mat');

                $("#id-tab-mat").html(result);
                // $('#id-tab-mat').empty().append($(result));
            });

        }

        function actualizarTabla(url) {
            $.ajax({
                url: url,
                success: function (data) {
                    $('#id-tab-mat').empty();
                    $('#id-tab-mat').html(data);
                }
            });
        }

        function ShowSelectedCarrera() {
            /* Para obtener el valor */
            var cod = document.getElementById("selecCarrera").value;
            document.getElementById("idCarrera").value = cod;
        }

        function ShowSelectedCiclo() {
            var cod = document.getElementById("selectCiclo").value;
            document.getElementById("idCiclos").value = cod;

        }

        $('#selecCarrera').change(function () {
            $('#selecCiclo').val('4');
        });

        $(document).on('click', '.btn-delete', function (e) {
            var idmat = $(this).data('id-mat');
            swal({
                title: "Esta Seguro?",
                text: "Desea eliminar este registro.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-info",
                confirmButtonText: "Si, Eliminar!",
                cancelButtonText: "No, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    var varurl = "{{route('eliminar-materia')}}";
                    var pathname = window.location.search;
                    //    $("#" + divresul + "").html($("#cargando").html());
                    $.ajax({
                        // la URL para la petición
                        url: varurl,
                        type: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: idmat,
                            _token: "{{csrf_token()}}",
                            _method: "delete",
                        },
                        success: function (data) {
                            if (data.mensaje != 'Error al eliminar el registro') {
                                $('#notificacion-delete').html('<div class="alert alert-success"><h4>' + data.mensaje + ' </h4></div>');
                                $('.col-mat' + idmat).remove();
                                $("html, body").animate({
                                    scrollTop: $('#notificacion-delete').offset().top
                                });

                                if (pathname != '') {
                                    // alert(pathname);
                                    var url = '/pagina-materias' + pathname + '&page=';

                                    actualizarTabla(url);
                                }
                                else {
                                    // alert('vacio');
                                    var url = '/pagina-materias?page=';
                                    actualizarTabla(url);
                                }

                            } else {
                                $('#notificacion-delete').html('<div class="alert alert-danger"><h4>' + data.mensaje + ' </h4></div>');

                            }

                        },
                        error: function (data) {

                            if (data.mensaje == 'Error al eliminar el registro') {
                                $('#notificacion-delete').html('<div class="alert alert-danger"><h4>' + data.mensaje + ' </h4></div>');

                            }
                        }
                    });
                    swal("Creado!", "Registro eliminado exitosamente.", "success");
                } else {
                    swal("Cancelado!", "Desea cancelar la operacion", "error");
                }
            });
        });

    </script>
@endsection


<!--<script type="text/javascript">
    setTimeout("materiasCreadas()",500);
</script>-->


<!-- Incluye el modal para subir los parametros de los portafolio-->
@include('Docente/modalParametroPortafolio')