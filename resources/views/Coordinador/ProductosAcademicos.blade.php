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
        <form action="" class="form-form" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="col-md-10">

                <div class="box box-primary">

                    <div class="box-header text-center">
                        <legend><label>REGISTRO PRODUCTOS ACADÉMICOS</label></legend>
                    </div><!--Cierre box header-->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">NOMBRE*</span></b>
                            </div><!---->
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group text-center">
                                    <input type="hidden" class="form-control" id="id-pro" name="id-pro">
                                    <div id="div-nombre">
                                        <input placeholder="Nombre del nuevo producto académico" type="text"
                                               class="form-control" id="nombre" name="nombre" required>
                                    </div>

                                </div>

                            </div>

                        </div><!--CIERRE ROW-->

                        <div class="row form-group">
                            <div class="col-md-1">
                            </div>
                            <div id="section-btn">
                                <div class="col-md-3 text-right">
                                    <button class="btn btn-primary btn-lg btn-block btn-save" type="button">
                                        Agregar producto
                                    </button>
                                </div>
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
                    <legend><label>Productos académicos</label></legend>
                </div><!--cERRAR BOX HEADER-->
                <div class="box-body">

                    <div class="form-group text-center">
                        <div class="row">
                            <div class="col-md-1"></div>

                            <div class="col-md-10">
                                <div id="notificacion-delete"></div>
                                <div id="id-tab-mat">
                                    @include('Coordinador.tablaProductos')
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
        function refrescarTabla() {
            $('#nombre').val('');
            $('#div-nombre').removeClass('has-error');
            var url = 'refrescar-tabla-productos';
            $.get(url, function (result) {
                $("#id-tab-mat").html(result);
            });
        }

        function cargarSeccionAgregar() {
            $('#div-nombre').removeClass('has-error');
            $('#section-btn').html(' ' +
                '<div class="col-md-3 text-right">' +
                '      <button class="btn btn-primary btn-lg btn-block btn-save" type="button">\n' +
                '            Agregar producto' +
                '       </button>' +
                '</div>'
            );
        }

        function caragarSeccionEditar() {
            $('#div-nombre').removeClass('has-error');
            $('#section-btn').html(' ' +
                '    <div class="col-lg-3">' +
                '        <button class="btn btn-danger btn-lg btn-block btn-close" type="button">' +
                '            Cancelar' +
                '        </button>' +
                '    </div>' +
                '    <div class="col-lg-3">' +
                '        <button class="btn btn-primary btn-lg btn-block btn-change" type="button">' +
                '            Guardar cambios' +
                '        </button>' +
                '    </div>'
            );
        }

        $(document).on('click', '.btn-delete', function (e) {
            var idpro = $(this).data('id-pro');
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
                    var varurl = "producto-destroy";
                    $.ajax({
                        url: varurl,
                        type: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: idpro,
                            _token: "{{csrf_token()}}",
                            _method: "delete",
                        },
                        success: function (data) {
                            $('#notificacion-delete').html('<div class="alert alert-success"><h5>' + data.mensaje + ' </h5></div>');
                            refrescarTabla();
                            cargarSeccionAgregar();
                        },
                        error: function (data) {

                            if (data.mensaje == 'Error al eliminar el registro') {
                                $('#notificacion-delete').html('<div class="alert alert-danger"><h5>' + data.mensaje + ' </h5></div>');

                            }
                        }
                    });
                    swal("Creado!", "Registro eliminado exitosamente.", "success");
                } else {
                    swal("Cancelado!", "Desea cancelar la operacion", "error");
                }
            });
        });

        $(document).on('click', '.btn-save', function (e) {
            var nombre = $('#nombre').val();

            if (nombre != '') {


                url = "{{route('producto-store')}}";
                $.ajax({
                    url: url,
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        nombre: nombre,
                        _token: "{{csrf_token()}}",
                        _method: "post",
                    },
                    success: function (data) {
                        $('#notificacion-delete').html('<div class="alert alert-success"><h5>' + data.mensaje + ' </h5></div>');
                        refrescarTabla();
                    }
                });
            } else {
                $('#div-nombre').addClass('has-error');
            }
        });

        $(document).on('click', '.btn-edit', function (e) {
            $('#nombre').val($(this).data('nombre'));
            $('#id-pro').val($(this).data('id-pro'));
            caragarSeccionEditar();

        });

        $(document).on('click', '.btn-change', function (e) {
            var idpro = $('#id-pro').val();
            var nombre = $('#nombre').val();
            $.ajax({
                type: 'put',
                url: 'producto-update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idpro,
                    nombre: nombre,
                    _token: '{{csrf_token()}}',
                    _method: 'put',
                },
                success: function (data) {
                    refrescarTabla();
                    $('#notificacion-delete').html('<div class="alert alert-success"><h5>' + data.mensaje + ' </h5></div>');
                    cargarSeccionAgregar();
                },
                error: function (data) {
                    $('#notificacion-delete').html('<div class="alert alert-danger"><h5> Error al momento de eliminar  el registro</h5></div>');
                    $('#nombre').val('');
                    cargarSeccionAgregar();
                }

            });
        });

        $(document).on('click', '.btn-close', function (e) {
            $('#nombre').val('');
            cargarSeccionAgregar();
        });

    </script>
@endsection
