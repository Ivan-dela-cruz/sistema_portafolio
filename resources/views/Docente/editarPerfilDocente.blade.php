@extends('principal')
@section('title','Perfil Docente')
@section('content')


<script type="text/javascript">


$(document).ready(function() {
  alert("hola");// Instrucciones a ejecutar al terminar la carga
});

</script>

<section class="content" id="contenido_principal" >
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        Editar información Docente
                    </h3>
                </div>
                <!-- /.box-header -->
                <div id="notificacion">
                </div>
                <!-- action  editor se pued utilizar directamente  pero se recarga toda la  pagina  podemos borrar el action igual funciona -->
                <!-- En este caso utilizamos ajax con la clase Form_entrada para no recargar toda la pg -->
                <form action="editar_docente" class="form-horizontal form_entrada" id="frm_editar_docente" method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="idDocente" type="hidden" value="{{$usuario->id}}">
                            <div class="box-body ">
                                <div class="form-group col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label for="nombre">
                                                Nombres*
                                            </label>
                                            <input class="form-control" id="nombre" name="nombre" required="" type="text" value="{!! $usuario->nombre !!}">
                                                <label style="color:#8D8A8A; font-size:12px">
                                                    Nombres completos
                                                </label>
                                            </input>
                                        </div>
                                        <div class="col-xs-0">
                                        </div>
                                        <div class="col-xs-6">
                                            <label for="apellido">
                                                Apellidos*
                                            </label>
                                            <input class="form-control" id="apellido" name="apellido" required="" type="text" value="{!! $usuario->apellido !!}">
                                                <label style="color:#8D8A8A; font-size:12px">
                                                    Apellidos Completos
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="cedula">
                                        Cedula*
                                    </label>
                                    <input class="form-control" id="cedula" name="cedula" readonly="" type="text" value="{{ $usuario->cedula }}">
                                    </input>
                                </div>
                                <div class="form-group col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label for="celular">
                                                Número de Celular:*
                                            </label>
                                            <input class="form-control" id="celular" name="celular" pattern="[0-9]{10}" required="" title="Ingrese 10 Dígitos" type="tel" value="{{ $usuario->celular }}">
                                                <label style="color:#8D8A8A; font-size:12px">
                                                    Ejemplo. (0992266335) 10 dígitos
                                                </label>
                                            </input>
                                        </div>
                                        <div class="col-xs-0">
                                        </div>
                                        <div class="col-xs-6">
                                            <label for="telefono">
                                                Número de Teléfono:
  *
                                            </label>
                                            <input autocomplete="false" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" required="" title="Ingrese 9 Dígitos" type="tel" value="{!! $usuario->telefono !!}">
                                                <label style="color:#8D8A8A; font-size:12px">
                                                    Ejemplo. (03)2266335  9 dígitos
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>
                                                Lugar*
                                            </label>
                                            <input class="form-control" id="lugar" name="lugar" required="" type="text" value="{{$usuario->lugarNacimiento}}">
                                                <label style="color:#8D8A8A; font-size:12px">
                                                    Ejemplo Ciudad.
                                                </label>
                                            </input>
                                        </div>
                                        <div class="col-xs-0">
                                        </div>
                                        <div class="col-xs-6">
                                            <label>
                                                Fecha de Nacimiento*
                                            </label>
                                            <input class="form-control" id="fecha" name="fecha" required="" type="date" value="{{ $usuario->fechaNacimiento}}">
                                                <label style="color:#8D8A8A;font-size: 12px ">
                                                    Seleccione Fecha.
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>
                                        Dirección Domiciliaria*
                                    </label>
                                    <textarea class="form-control" id="direccionDomi" name="direccionDomi" required="" type="text">{{$usuario->direccion}}</textarea>
                                    <label style="color:#8D8A8A;font-size: 12px ">
                                        Barrio, Calle Principal, Calle Secundaria, Número de Casa, donde vive actualmente
                                    </label>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="cargasFamiliar">
                                        Número de cargas Familiares:*
                                    </label>
                                    <select class="form-control" id="cargasFamiliar" name="cargasFamiliar" required="">
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
                                        <option value="12">
                                            Mayor a 10
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="sexo">
                                        Género*
                                    </label>
                                    <select class="form-control" id="sexo" name="sexo" required="">
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
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="nacionalidad">
                                        Nacionalidad:*
                                    </label>
                                    <select class="form-control" id="nacionalidad" name="nacionalidad" required="">
                                        <option value="">
                                            --SELECCIONE NACIONALIDAD --
                                        </option>
                                        <option value="1">
                                            ARGENTINA
                                        </option>
                                        <option value="2">
                                            BOLIVIANA
                                        </option>
                                        <option value="3">
                                            BRASILENA
                                        </option>
                                        <option value="4">
                                            CHILENA
                                        </option>
                                        <option value="5">
                                            COLOMBIANA
                                        </option>
                                        <option value="6">
                                            CUBANA
                                        </option>
                                        <option value="7">
                                            ECUATORIANA
                                        </option>
                                        <option value="8">
                                            MEXICANA
                                        </option>
                                        <option value="9">
                                            PARAGUAYA
                                        </option>
                                        <option value="10">
                                            PERUANA
                                        </option>
                                        <option value="11">
                                            URUGUAYA
                                        </option>
                                        <option value="12">
                                            VENEZOLANA
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="estado">
                                        Estado Civil:*
                                    </label>
                                    <select class="form-control" id="estado" name="estado" required="">
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
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    Actualizar Datos
                                </button>
                            </div>
                        </input>
                    </input>
                </form>
            </div>
        </div>
        <!-- end col mod 6 -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        Cambiar Fotografia
                    </h3>
                </div>
                <!-- /.box-header -->
                <div id="notificacionImagen">
                </div>
                <form action="subir_imagen" class="formarchivo text-center" enctype="multipart/form-data" id="frm_subir_imagen" method="post" name="frm_subir_imagen">
                    <input name="id_usuario_foto" type="hidden" value="{!!$usuario->id!!}">
                        <input id="_token" name="_token" type="hidden" value="{{ csrf_token()}}">
                            <div class="box-body">
                                <div class="form-group col-xs-12">
                                    @if(!$usuario->foto)
    @php $fotoUser="imagenes/avatar.png"; @endphp
    @else
    @php $fotoUser=$usuario->foto; @endphp
    @endif
                                    <img alt="User Image" class="img-circle" id="fotografia_usuario" name="fotografia_usuario" src="{{ url($fotoUser) }}" style="width:130px;height:135px;">
                                        <!-- User image -->
                                    </img>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>
                                        Agregar Imagen
                                    </label>
                                    <input accept="image/*" class="archivo form-control" id="archivo" name="archivo" required="" type="file"/>
                                </div>
                                <div class="box-footer text-center">
                                    <button class="btn btn-primary" type="submit">
                                        Actualizar Imagen
                                    </button>
                                </div>
                            </div>
                        </input>
                    </input>
                </form>
            </div>
        </div>
        <!-- end col mod 6 -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Historial Personal
                    </h3>
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
                                        Facultad Académica en la que labora..
                                    </label>
                                    <select class="form-control" id="facultad" name="facultad" required="">
                                        <option value="">
                                            -- SELECCIONE FACULTAD --
                                        </option>
                                        <option value="1">
                                            Ciencias de la Ingeniería y Aplicadas
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleIngresoUtc">
                                        Fecha ingreso a la UTC:
                                    </label>
                                    <input class="form-control" id="ingresoUtc" name="ingresoUtc" required="" type="month" value="{!! $usuario->fechaIngresoUtc !!}">
                                    </input>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    Cambiar Datos
                                </button>
                            </div>
                        </input>
                    </input>
                </form>
            </div>
        </div>
        <!-- end col mod 6 -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Cambiar Password
                    </h3>
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
                                    <input class="form-control" id="email_usuario" name="email" placeholder="Entrar email" readonly="" type="email" value="{{ $usuario->email}}">
                                    </input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">
                                    </label>
                                    <input class="form-control" id="clave" name="clave" placeholder="Password" required="" type="password">
                                    </input>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    Cambiar Datos
                                </button>
                            </div>
                        </input>
                    </input>
                </form>
            </div>
        </div>
        <!-- end col mod 6 -->
    </div>
    <!-- end row -->

<div class="row">
    <div class="col-md-12 text-center">
<a  href="{{URL::to('/getPDF').'/'. base64_encode(Auth::user()->id)}}" target="black" class="btn btn-lg btn-danger">Generar PDF Perfil </a>
    </div>
</div>


<body onload="cargarCombox()"></body>

    <script>
        //Cargra datos conbox
   function cargarCombox(){
  $('#sexo option:eq({{ $usuario->sexo}})').prop('selected', true);
  $('#nacionalidad option:eq({{ $usuario->nacionalidad }})').prop('selected',true);
  $('#estado option:eq({{ $usuario->estadoCivil }} )').prop('selected',true);
  $('#cargasFamiliar option:eq({{$usuario->cargaFamiliar}})').prop('selected',true);
  $('#facultad option:eq({!! $usuario->facultad !!})').prop('selected',true);
  }


  //setTimeout('cargarCombox()',300);


    </script>
</section>
@endsection
