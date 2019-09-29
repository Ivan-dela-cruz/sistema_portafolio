@extends('principal')
@section('title','Potafolios Creados')
@section('content')

    <section class="container-fluid spark-screen" id="contenido_principal">
        <div class="row">
            <div class="col-md-12">
                <div id="notificacion">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>TIEMPO DE SUBIDA DEL PORTAFOLIO</label></legend>
                    </div><!-- Cierre del box header-->
                    <div class="form-group text-center" id="notificacion_crear_portafolio"></div>
                    <div class="box-body">
                        <form action="habilitar_subida_documentos" class="form-horizontal frm_habilitar_tiempo"
                              id="frm_habilitar_eliminar"
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
                                            <select class="form-control selectTiempo" id="periodoh"
                                                    name="periodoh"
                                                    required=""
                                                    onchange="ShowSelected();">
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

                            {{--- <div class="form-group text-center">
                                 <b> <span style="font-size:18px;">ESTABLECER HORA Y FECHA*</span></b>
                             </div>
                             --}}


                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <b> <span style="font-size:18px;">PORTADA*</span></b>
                                    </div>
                                    <div class="form-group">
                                        <h4><input hidden class="form-control" type="hidden" required id="id_tarea"
                                                   name="id_tarea"></h4>
                                        <label class="text-left" for="">Fecha límite</label>
                                        <h4><input class="form-control" type="date" required id="fecha_fin"
                                                   name="fecha_fin"></h4>
                                        <label class="text-left" for="">Hora límite</label>
                                        <h4><input class="form-control" type="time" required id="hora_fin"
                                                   name="hora_fin"></h4>

                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <b> <span style="font-size:18px;">PARÁMETROS*</span></b>
                                    </div>
                                    <div class="form-group">
                                        <h4></h4>
                                        <label class="text-left" for="">Fecha límite</label>
                                        <h4><input class="form-control" type="date" required id="fecha_fin_par"
                                                   name="fecha_fin_par"></h4>
                                        <label class="text-left" for="">Hora límite</label>
                                        <h4><input class="form-control" type="time" required id="hora_fin_par"
                                                   name="hora_fin_par"></h4>

                                    </div>
                                </div>
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


            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>ESTADO DEL TIEMPO DE SUBIDA DE DOCUMENTOS</label></legend>
                    </div><!--cERRAR BOX HEADER-->
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">

                                <div id="divTiempo" class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                scope="col"></th>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                colspan="2" scope="col">Portada del Portafolio
                                            </th>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                colspan="2" scope="col">Parámetros del portafolio
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse; text-align: center;"
                                                scope="col">Período
                                            </th>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                scope="col">fecha
                                            </th>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                scope="col">hora
                                            </th>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                scope="col">fecha
                                            </th>
                                            <th style="border: #cabecb 1px solid; border-collapse: collapse;"
                                                scope="col">hora
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @if(count($tiempoTarea))

                                            @foreach($tiempoTarea as $tiempota)
                                                <tr class="tiempo{{$tiempota->id}}">
                                                    <td style="border: #cabecb 1px solid; border-collapse: collapse;">{!! $tiempota->periodo->desde !!}
                                                        - {!! $tiempota->periodo->hasta !!}</td>
                                                    <td style="border: #cabecb 1px solid; border-collapse: collapse;">{!! $tiempota->fecha_fin_portada !!}</td>
                                                    <td style="border: #cabecb 1px solid; border-collapse: collapse;">{!! $tiempota->hora_fin_portada !!}</td>
                                                    <td style="border: #cabecb 1px solid; border-collapse: collapse;">{!! $tiempota->fecha_fin_materia !!}</td>
                                                    <td style="border: #cabecb 1px solid; border-collapse: collapse;">{!! $tiempota->hora_fin_materia !!}</td>
                                                </tr>

                                            @endforeach
                                            {{$tiempoTarea->render()}}
                                        @else
                                            <!--Si no existe periodo academico registrado-->

                                            <h4 value="">
                                                No existe Período Académico Registrado
                                            </h4>

                                        @endif
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


        </div><!--Cierre del primer row-->


    </section>




    <body onload="buscarPortafolio()"></body>
@endsection
@section('javascript')
    <script src="{{asset('js/metodo.js')}}"></script>
    <script type="text/javascript">
        function ShowSelected() {
            /* Para obtener el valor */
            var cod = document.getElementById("periodoh").value;
            document.getElementById("id_tarea").value = cod;
        }

        $('.selectTiempo').change(function () {
            var id = $(this).val();
            $.ajax({
                url: "busqueda-tiempo/{id}",
                method: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#fecha_fin').val(data.fecha_fin_portada);
                    $('#hora_fin').val(data.hora_fin_portada);
                    $('#fecha_fin_par').val(data.fecha_fin_materia);
                    $('#hora_fin_par').val(data.hora_fin_materia);
                }
            })


        });


        //mODIFICAR TIEMPOS DE SUBIDA DEL ARCHIVO
        $(document).on("submit", ".frm_habilitar_tiempo", function (e) {
            e.preventDefault();

            var quien = $(this).attr("id");
            var formu = $(this);
            var varurl = $(this).attr("action");
            var cual = 0;

            swal({
                title: "Esta Seguro?",
                text: "Desea cambiar tiempo de subida.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-info",
                confirmButtonText: "Si, Actualizar!",
                cancelButtonText: "No, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    var varurl = "habilitar_subida_documentos";
                    var divresul = "notificacion_crear_portafolio";
                    res = true;
                    //    $("#" + divresul + "").html($("#cargando").html());
                    $.ajax({
                        // la URL para la petición
                        url: varurl,
                        data: formu.serialize(),
                        type: 'POST',
                        dataType: "html",
                        success: function (data) {
                            obj = JSON.parse(data);
                            $("#" + divresul + "").html('<div class="alert alert-info text-center"> <label>' + obj.msj + '</label> </div>');
                            // $("#" + divresul + "").html(resul);
                            $('.tiempo' + obj.id).replaceWith(
                                '' +
                                '<tr class="tiempo' + obj.id + '">' +
                                '<td style="border: #cabecb 1px solid; border-collapse: collapse;">' + obj.periodo + '</td>' +
                                '<td style="border: #cabecb 1px solid; border-collapse: collapse;">' + obj.fecha_por + '</td>' +
                                '<td style="border: #cabecb 1px solid; border-collapse: collapse;">' + obj.hora_por + '</td>' +
                                '<td style="border: #cabecb 1px solid; border-collapse: collapse;">' + obj.fecha_par + '</td>' +
                                '<td style="border: #cabecb 1px solid; border-collapse: collapse;">' + obj.hora_par + '</td>' +
                                '</tr>'
                            );
                            irarriba();

                        },
                        error: function (data) {
                            var lb = "";
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function (key, value) {
                                $("#" + key + "_group").addClass("has-error");
                                $("#" + key + "_span").text(value);
                            });
                            $("#" + divresul + "").html('');
                        }
                    });
                    swal("Creado!", "Tiempo de actualizado exitosamente.", "success");
                } else {
                    swal("Cancelado!", "Desea cancelar la operacion", "error");
                }
            });


        });
    </script>

@endsection