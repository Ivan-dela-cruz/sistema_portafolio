@extends('principal')
@section('title','Perfil Docente')
@section('content')



    <section class="content" id="contenido_principal">
        <div class="row">
            <div class="col-md-7">


                <div class="box box-primary">

                    <div class="box-header with-border text-center">
                        <h4 class="box-title">
                            Editar información personal
                        </h4>
                    </div>

                    <div class="box-body">

                        <form action="editar_docente" class="form-horizontal form_entrada_validacion"
                              id="frm_editar_docente" method="post">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input name="idDocente" type="hidden" value="{{$usuario->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="notificacion">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="nombre_group">
                                        <label class="col-md-3" for="nombre"> Nombres* </label>
                                        <div class="col-md-9">
                                            <span class="help-block" id="nombre_span"> </span>
                                            <input type="text" class="form-control" id="nombre"
                                                   value="{{ $usuario->nombre }}" name="nombre">

                                            <label style="color:#8D8A8A; font-size:12px">Nombres completos</label>
                                        </div><!--Cierre col 9-->

                                    </div><!--Cierre from-group-->
                                </div><!--Cierre col-6-->


                                <div class="col-md-6">
                                    <div class="form-group" id="apellido_group">
                                        <label class="col-md-3" for="apellido"> Apellidos* </label>
                                        <div class="col-md-9">
                                            <span class="help-block" id="apellido_span"> </span>
                                            <input type="text" class="form-control" id="apellido"
                                                   value="{{ $usuario->apellido }}" name="apellido">
                                            <label style="color:#8D8A8A; font-size:12px">Apellidos Completos </label>
                                        </div><!--Cierre col 9-->
                                    </div><!--Cierre from-group-->
                                </div> <!--Cierre col6-->
                            </div>   <!--Cierer row-->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="cedula_group">
                                        <label class="col-md-2" for="cedula">N° cédula* </label>
                                        <div class="col-md-7">
                                            <span class="help-block" id="cedula_span"> </span>
                                            <input type="text" class="form-control" id="cedula"
                                                   value="{{ $usuario->cedula}}" readonly="" name="cedula">
                                            <label style="color:#8D8A8A; font-size:12px">
                                                Ejemplo. (xxxxxxxxxx) 10 dígitos
                                            </label>
                                        </div><!--Cierre col 7-->

                                        <div class="col-md-3"></div>

                                    </div><!--Cierre from-group-->
                                </div>
                            </div><!--Cierre row-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="celular_group">
                                        <label class="col-sm-3" for="celular">Celular*</label>
                                        <div class="col-sm-9">
                                            <span class="help-block" id="celular_span"> </span>
                                            <input type="text" class="form-control" id="celular"
                                                   value="{{ $usuario->celular }}" name="celular">
                                            <label style="color:#8D8A8A; font-size:12px">
                                                Ejemplo. (xxxxxxxxxx) 10 dígitos
                                            </label>
                                        </div>


                                    </div><!-- /.form-group -->

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group" id="telefono_group">
                                        <label class="col-md-3" for="telefono">Teléfono </label>
                                        <div class="col-md-9">
                                            <span class="help-block" id="telefono_span"> </span>
                                            <input type="text" class="form-control" id="telefono"
                                                   value="{{ $usuario->telefono}}" name="telefono">
                                            <label style="color:#8D8A8A; font-size:12px">
                                                Ejemplo. (xx)xxxxxx 9 dígitos
                                            </label>
                                        </div><!--Cierre col 9-->

                                    </div><!--Cierre from-group-->

                                </div>


                            </div><!--Cierer row-->


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="lugar_group">
                                        <label class="col-sm-3" for="lugar">Lugar*</label>
                                        <div class="col-sm-9">
                                            <span class="help-block" id="lugar_span"> </span>
                                            <input type="text" class="form-control" id="lugar"
                                                   value="{{ $usuario->lugarNacimiento }}" name="lugar">
                                            <label style="color:#8D8A8A; font-size:12px">
                                                Ejemplo. Ciudad (Latacunga)
                                            </label>
                                        </div>


                                    </div><!-- /.form-group -->

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group" id="fecha_group">
                                        <label class="col-md-3" for="fecha">Fecha*</label>
                                        <div class="col-md-9">
                                            <span class="help-block" id="fecha_span"> </span>
                                            <input type="date" class="form-control" id="fecha" required=""
                                                   value="{{ $usuario->fechaNacimiento}}" name="fecha">
                                            <label style="color:#8D8A8A; font-size:12px">
                                                Seleccione fecha Nacimiento.
                                            </label>
                                        </div><!--Cierre col 9-->

                                    </div><!--Cierre from-group-->

                                </div>


                            </div><!--Cierer row-->


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group" id="direccionDomi_group">
                                        <label class="col-md-2" for="direccionDomi">Dirección Domiciliaria* </label>
                                        <div class="col-md-10">
                                            <span class="help-block" id="direccionDomi_span"> </span>
                                            <textarea class="form-control" id="direccionDomi" name="direccionDomi"
                                                      type="text">{{$usuario->direccion}}</textarea>
                                            <label style="color:#8D8A8A;font-size: 12px ">
                                                Barrio, Calle Principal, Calle Secundaria, Número de Casa, donde vive
                                                actualmente
                                            </label>
                                        </div><!--Cierre col 7-->


                                    </div><!--Cierre from-group-->


                                </div>
                            </div><!--Cierre row-->


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group" id="cargasFamiliar_group">
                                        <label class="col-md-4" for="cargasFamiliar">N° Cargas Familiares*</label>
                                        <div class="col-md-8">
                                            <span class="help-block" id="cargasFamiliar_span">  </span>
                                            <select class="form-control" id="cargasFamiliar" name="cargasFamiliar">
                                                <option value="">
                                                    --SELECCIONE CARGAS FAMILIARES --
                                                </option>
                                                <option value="1">
                                                    0
                                                </option>
                                                <option value="2">
                                                    1
                                                </option>
                                                <option value="3">
                                                    2
                                                </option>
                                                <option value="4">
                                                    3
                                                </option>
                                                <option value="5">
                                                    4
                                                </option>
                                                <option value="6">
                                                    5
                                                </option>
                                                <option value="7">
                                                    6
                                                </option>
                                                <option value="8">
                                                    7
                                                </option>
                                                <option value="9">
                                                    8
                                                </option>
                                                <option value="10">
                                                    9
                                                </option>
                                                <option value="11">
                                                    10
                                                </option>

                                            </select>


                                        </div><!--Cierre col 8-->

                                    </div><!--Cierre from-group-->
                                </div>
                            </div> <!--cierre row-->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="sexo_group">
                                        <label class="col-md-4" for="sexo">Género*</label>
                                        <div class="col-md-8">
                                            <span class="help-block" id="sexo_span">  </span>

                                            <select class="form-control" id="sexo" name="sexo">
                                                <option value="">
                                                    -- SELECCIONE GÉNERO --
                                                </option>
                                                <option value="1 ">
                                                    FEMENINO
                                                </option>
                                                <option value="2 ">
                                                    MASCULINO
                                                </option>
                                            </select>

                                        </div><!--Cierre col 8-->

                                    </div><!--Cierre from-group-->
                                </div>
                            </div> <!--cierre row-->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="nacionalidad_group">
                                        <label class="col-md-4" for="nacionalidad">Nacionalidad*</label>
                                        <div class="col-md-8">
                                            <span class="help-block" id="nacionalidad_span">  </span>


                                            <select class="form-control" id="nacionalidad" name="nacionalidad">
                                                <option value="">
                                                    --SELECCIONE NACIONALIDAD --
                                                </option>
                                                <option value="1">
                                                    ECUATORIANA
                                                </option>
                                                <option value="2">
                                                    CUBANA
                                                </option>

                                                <option value="3">
                                                    CHILENA
                                                </option>
                                                <option value="4">
                                                    COLOMBIANA
                                                </option>

                                                <option value="5">
                                                    PERUANA
                                                </option>

                                                <option value="6">
                                                    VENEZOLANA
                                                </option>
                                                <option value="7">
                                                    ESPAÑOLA
                                                </option>
                                                <option value="8">
                                                    OTRA NACIONALIDAD
                                                </option>

                                            </select>

                                        </div><!--Cierre col 8-->

                                    </div><!--Cierre from-group-->
                                </div>
                            </div> <!--cierre row-->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="estado_group">
                                        <label class="col-md-4" for="estado">Estado Civil*</label>
                                        <div class="col-md-8">
                                            <span class="help-block" id="estado_span">  </span>

                                            <select class="form-control" id="estado" name="estado">
                                                <option value="">
                                                    -- SELECCIONE ESTADO CIVIL --
                                                </option>
                                                <option value="1">
                                                    CASADO(A)
                                                </option>
                                                <option value="2">
                                                    DIVORCIADO(A)
                                                </option>
                                                <option value="3">
                                                    SEPARADO(A)
                                                </option>
                                                <option value="4">
                                                    SOLTERO(A)
                                                </option>
                                                <option value="5">
                                                    UNION LIBRE
                                                </option>
                                                <option value="6">
                                                    VIUDO(A)
                                                </option>
                                            </select>

                                        </div><!--Cierre col 8-->

                                    </div><!--Cierre from-group-->
                                </div>
                            </div> <!--cierre row-->

                            <div class="row">
                                <br>
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary" type="submit">
                                        Actualizar Datos
                                    </button>

                                </div>

                            </div>

                            <br>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="{{URL::to('/getPDF').'/'. base64_encode(Auth::user()->id)}}" target="black"
                                       class="btn btn-lg btn-danger">Generar PDF Perfil </a>
                                </div>
                            </div>


                    </div> <!--Cierre box body-->

                    </form>

                    <div class="box-footer"></div>

                </div><!--Cierre box Primary-->


            </div><!--Cierre col-6-->
            <div class="col-md-5">


                <div class="box box-primary">
                    <div class="box-header text-center"><h4>Cambiar Fotografia</h4></div>
                    <div class="row">
                        <!-- /.box-header -->
                        <div class="col-md-12">
                            <div id="notificacionImagen">
                            </div>
                        </div>
                    </div>

                    <form action="subir_imagen" class="formarchivo text-center" enctype="multipart/form-data"
                          id="frm_subir_imagen" method="post" name="frm_subir_imagen">
                        <input name="id_usuario_foto" type="hidden" value="{!!$usuario->id!!}">
                        <input id="_token" name="_token" type="hidden" value="{{ csrf_token()}}">
                        <div class="box-body">
                            <div class="form-group col-xs-12">
                                @if(!$usuario->foto)
                                    @php $fotoUser="imagenes/avatar.png"; @endphp
                                @else
                                    @php $fotoUser=$usuario->foto; @endphp
                                @endif
                                <img alt="User Image" class="img-circle" id="fotografia_usuario"
                                     name="fotografia_usuario" src="{{ url($fotoUser) }}"
                                     style="width:130px;height:135px;">
                                <!-- User image -->

                            </div>
                            <div class="form-group col-xs-12">
                                <label>
                                    Agregar Imagen
                                </label>
                                <input accept="image/*" class="archivo form-control" id="archivo" name="archivo"
                                       required="" type="file"/>
                            </div>
                            <div class="box-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    Actualizar Imagen
                                </button>
                            </div>
                        </div>

                    </form>
                </div>


                <div class="box box-primary">
                    <div class="box-header with-border text-center">
                        <h4>
                            Historial Personal
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div id="notificacion_cambiarHistorial">
                    </div>
                    <!-- form start -->
                    <form action="cambiar_historial" class="form_entrada" id="frm_cambiar_historial" method="post">
                        <input name="idDoc" type="hidden" value="{{ $usuario->id}}">
                        <input id="_token" name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Facultad Académica
                                </label>
                                <input type="hidden" value="1" id="facultad" name="facultad">

                                <input class="form-control" readonly="" required="" type="text"
                                       value="Ciencias de la Ingeniería y Aplicadas">


                            </div>
                            <div class="form-group">
                                <label for="exampleIngresoUtc">
                                    Fecha ingreso a la UTC:
                                </label>
                                <input class="form-control" id="ingresoUtc" name="ingresoUtc" required="" type="month"
                                       value="{!! $usuario->fechaIngresoUtc !!}">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button class="btn btn-primary" type="submit">
                                Actualizar Datos
                            </button>
                        </div>
                    </form>
                </div>


                <div class="box box-primary">
                    <div class="box-header with-border text-center">
                        <h4 class="box-title">
                            Cambiar Contraseña
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div id="notificacion_cambiarClave">
                    </div>
                    <!-- form start -->
                    <form action="cambiar_clave" class="form_entrada" id="frm_cambiar_clave" method="post">
                        <input name="idUsu" type="hidden" value="{{$usuario->id}}">
                        <input id="_token" name="_token" type="hidden" value="{{ csrf_token()}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Correo Electrónico
                                </label>
                                <input class="form-control" id="email_usuario" name="email" placeholder="Entrar email"
                                       readonly="" type="email" value="{{ $usuario->email}}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">
                                </label>
                                <input class="form-control" id="clave" name="clave" placeholder="Password"
                                       type="password">

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button class="btn btn-primary" type="submit">
                                Actualizar Datos
                            </button>
                        </div>
                    </form>
                </div>


            </div><!--Cierre col-6-->

        </div> <!--Cierre ror-->


        <body onload="cargarCombox()"></body>

        <script>
            //Cargra datos conbox
            function cargarCombox() {
                $('#sexo option:eq({{ $usuario->sexo}})').prop('selected', true);
                $('#nacionalidad option:eq({{ $usuario->nacionalidad }})').prop('selected', true);
                $('#estado option:eq({{ $usuario->estadoCivil }} )').prop('selected', true);
                $('#cargasFamiliar option:eq({{$usuario->cargaFamiliar}})').prop('selected', true);
                //$('#facultad option:eq({!! $usuario->facultad !!})').prop('selected',true);
                // $('#facultad option:eq(1)').prop('selected',true);
            }


            //setTimeout('cargarCombox()',300);


        </script>
    </section>
@endsection
