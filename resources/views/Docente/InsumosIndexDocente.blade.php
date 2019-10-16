@extends('principal')
@section('title','Insumos Docentes')
@section('content')

    <section class="container-fluid spark-screen" id="contenido_secundario">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <legend><label>Insumos Docentes</label></legend>
                    </div><!--cERRAR BOX HEADER-->
                    <div class="box-body">

                        <div class="form-group text-center">
                            <div class="row">
                                <div class="col-md-1"></div>

                                <div class="col-md-11">
                                    <div id="notificacion-delete"></div>
                                    <div id="id-tab-mat">
                                        @include('Docente.tablaInsumosDocentes')
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
@endsection