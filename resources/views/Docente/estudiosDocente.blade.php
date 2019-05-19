@extends('principal')

@section('title','Estudios Docente')

@section('content')
<!-- -->



    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header text-center">
                    <h3 class="box-title">
                        <b>
                        TÍTULOS OBTENIDOS
                        </b>
                    </h3>
                </div>






                <div class="form-group">
                    <div id="notaEstudio">
                    </div>
                </div>
                <form action="frm_agregar_titulo" class="form-horizontal form_entrada_validacion" id="frm_agregar_titulo" method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="idDoc" type="hidden" value="{{ $docente->id }}">
                            <div class="box-body ">
                                <div class="form-group col-xs-12">
                                    <label for="nivel">
                                        NIVEL
                                    </label>
                                    @if(count($nivel))
                                    <select class="form-control" id="nivel" name="nivel">
                                        @foreach($nivel as $nv)
                                        <option value="{{$nv->id}}">
                                            {!! $nv->nombre !!}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                              @if(count($nivel)==0)
                                    <b>
                                        <legend style="color:red;">
                                            Ingrese nivel de educación
                                        </legend>
                                        <b>
                                            @endif
                                        </b>
                                    </b>
                                </div>
                            






                                <div class="form-group col-xs-12" id="titulo_group">
                                    <label for="titulo">
                                        TITULO OBTENIDO
                                    </label>
                                      <span class="help-block" id="titulo_span"></span>
                                    <input class="form-control" id="titulo" name="titulo" title="Ingrese nombre Título" type="text" value="">
                                    
                                </div>
                            




                                <div class="form-group col-xs-12" id="fecha_group">
                                    <label for="fecha">
                                        FECHA DE REGISTRO
                                    </label>
                                      <span class="help-block" id="fecha_span"></span>
                                    <input class="form-control" id="fecha" name="fecha" title="Ingrese fecha registro"  type="date" value="">
                                    
                                </div>
                                <div class="form-group col-xs-12" id="codigoSnt_group">
                                    <label for="codigoSnt">
                                        CÓDIGO DEL REGISTRO  CONESUP O SENESCYT
                                    </label>
                                      <span class="help-block" id="codigoSnt_span"></span>
                                    <input class="form-control" id="codigoSnt" name="codigoSnt" type="text" value="">
                                    
                                </div>



                            </div>
                            <div class="box-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    Actualizar Títulos
                                </button>
                            </div>
                        </input>
                    </input>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">

<div class="box-header text-center">
                    <h3 class="box-title">
                        <b>
                       
  ESTUDIOS REALIZADOS
                        </b>
                    </h3>
                </div>

                <div class="box-body box-profile">
                    @if($docente->foto)
                @php
                $fotoUser=$docente->foto;
                @endphp
                  @else
                   @php $fotoUser="imagenes/avatar.png"; @endphp
                  @endif
                    <img alt="User profile picture" class="profile-user-img img-responsive img-circle" src="{{ url($fotoUser) }}">
                        <h3 class="profile-username text-center">
                            {{ $docente->nombre ." ". $docente->apellido }}
                        </h3>
                        <p class="text-muted text-center">
                            {{$docente->idRol }}
                        </p>



    <div id="notaBorrar">
                 </div>

                        <ul class="list-group list-group-unbordered"  id="ventanaModificarEstudioDoc">



                            @foreach($nivel as $nv)
                            <li class="list-group-item">
                                <i class="fa fa-book margin-r-5">
                                </i>
                                <b>
                                    --{{ $nv->nombre }} Nivel
                                </b>
                                <a class="pull-right">
                                </a>
                                <!--  variable del controlador del de  la relacion de unos a muchos se en cuentra el metos en Modelo users-->
                                @foreach($titulo->get() as $titu)
                                <!-- Pra claasificar segun la categoria-->
                                @if($titu->idNivel==$nv->id)
                                <br/>
                                <i class="fa fa-circle-o text-yellow">
                                </i>
                                <span class="text-light-blue">
                                    -{{$titu->nombre }}
                                </span>
                                <span>
                                    --   {!! $titu->fechaRegistro  !!}
                                </span>
                                <span>
                                    --  {!! $titu->codigoRegistro !!}
                                </span>
                                <span class="tools pull-right">
                                    <a href="javascript:void(0);" onclick="borrarTitulo({{ $titu->id }})">
                                        <i class="fa fa-trash-o">
                                        </i>
                                    </a>
                                </span>
                                @endif
        @endforeach
                            </li>
                            @endforeach
                        </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection