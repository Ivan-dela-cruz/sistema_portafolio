@extends('principal')
@section('title','Nuevo Insumo Docente')
@section('content')

    <section class="container-fluid spark-screen" id="contenido_principal">
        <div class="row">
            <div class="col-md-12">
                <div id="notificacion">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>NUEVO INSUMO DOCENTES</label></legend>
                    </div><!-- Cierre del box header-->
                    <div class="form-group text-center" id="notificacion_crear_portafolio"></div>
                    <div class="box-body">
                        <form action="guardar-insumos" class="form-horizontal" id=""
                              files="true" enctype="multipart/form-data"
                              method="post">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">PERÍODO ACADÉMICO*</span></b>
                            </div><!--Cierre del 2 group-->

                            <div class="form-group text-center">
                                <div class="row">

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">

                                        @if(count($periodos))
                                            <select class="form-control selectTiempo" id="id_periodo"
                                                    name="id_periodo"
                                                    required=""
                                                    onchange="ShowSelected();">
                                                <option value="">
                                                    --SELECCIONE PERÍODO--
                                                </option>
                                                @foreach($periodos as $p)

                                                    @if (old('id_periodo'))
                                                        <option @if ($p->id==old('id_periodo')) selected
                                                                @endif  value="{!! $p->id !!}">
                                                            {!! $p->desde !!} - {!! $p->hasta !!}
                                                        </option>
                                                    @else
                                                        <option value="{!! $p->id !!}">

                                                            {!! $p->desde !!} - {!! $p->hasta !!}
                                                        </option>
                                                    @endif

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
                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">Título del insumo*</span></b>
                            </div><!--Cierre del 2 group-->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <input value="{{old('titulo')}}" class="form-control" type="text" name="titulo"
                                               id="titulo" placeholder="Ingrese un título para el insumo">
                                        @if($errors->has('titulo'))
                                            <label class="text-danger">{{$errors->first('titulo')}} </label>
                                        @endif

                                    </div><!--Cierre del col-10-->
                                    <div class="col-md-1"></div>
                                </div>
                            </div>

                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">Descripción del insumo*</span></b>
                            </div><!--Cierre del 2 group-->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="descripcion" id="desc" cols="30" rows="4" placeholder="Escribir aquí">
                                                {{old('descripcion')}}
                                        </textarea>

                                        @if($errors->has('titulo'))
                                            <label class="text-danger">{{$errors->first('titulo')}} </label>
                                        @endif

                                    </div><!--Cierre del col-10-->
                                    <div class="col-md-1"></div>
                                </div>
                            </div>


                            <div class="col-md-1"></div>
                            <div class="form-group text-left">
                                <b> <span style="font-size:18px;">Archivos adjuntos*</span></b>
                                <b class="text-orange">(Máximo 5MB)</b>
                            </div><!--Cierre del 2 group-->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11">
                                        <div class="col-md-4 form-group">
                                            <label for="pdf"> PDF</label>
                                            <input type="file" name="url_pdf" id="pdf">
                                            @if($errors->has('url_pdf'))
                                                <label class="text-danger">{{$errors->first('url_pdf')}} </label>
                                            @endif
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="doc">WORD</label>
                                            <input type="file" name="url_doc" id="doc">
                                            @if($errors->has('url_doc'))
                                                <label class="text-danger">{{$errors->first('url_doc')}} </label>
                                            @endif
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="xls">EXCEL</label>
                                            <input type="file" name="url_xls" id="xls">
                                            @if($errors->has('url_xls'))
                                                <label class="text-danger">{{$errors->first('url_xls')}} </label>
                                            @endif
                                        </div>
                                    </div><!--Cierre del col-10-->
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success" type="submit"> CREAR INSUMO</button>
                            </div>
                        </form> <!-- Cierre del form-->

                    </div><!--Cierre box body-->

                    <br>

                    <div class="box-footer">

                    </div><!--Cierre box footer-->


                </div><!--Cierre del box-primary-->

            </div>   <!--Cierre del col-md-6-->

        </div><!--Cierre del primer row-->


    </section>

    <section class="container-fluid spark-screen" id="contenido_secundario">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>Insumos creados recientemente</label></legend>
                    </div><!--cERRAR BOX HEADER-->
                    <div class="box-body">

                        <div class="form-group text-center">
                            <div class="row">
                                <div class="col-md-1"></div>

                                <div class="col-md-11">
                                    <div id="notificacion-delete"></div>
                                    <div id="id-tab-mat">
                                         @include('Coordinador.tablaInsumosDocentes')
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
        </div>

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

    </script>

@endsection