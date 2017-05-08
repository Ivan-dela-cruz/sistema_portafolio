@extends('principal')
@section('title','Potafolios Creados')
@section('content')
<section class="content" id="contenido_principal">
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="form-group text-center">
                    <h2>
                        <b>
                            Crear Portafolio Docente
                        </b>
                    </h2>
                </div>
                <div class="form-group text-center" id="notificacion_crear_portafolio">
                </div>
                <div class="form-group text-center">
                    <h3>
                        Período Académico:
                    </h3>
                </div>
                <div class="form-group">
                    <form action="crear_portafolio" class="form-horizontal form_entrada" id="frm_crear_portafolio" method="post">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input name="idDocente" type="hidden" value="{{ Auth::user()->IdDoc}}">
                                <div class="form-group text-center">
                                    @if(count($periodo))
                                    <select class="form-control" id="periodo" name="periodo" required="">
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
                                    <b>
                                        <legend style="color:red;">
                                            No existe Período Académico Registrado
                                        </legend>
                                    </b>
                                    @endif
                                </div>
                                <div class="form-group text-center ">
                                    <h3>
                                        Carrera:
                                    </h3>
                                </div>
                                <div class="form-group text-center">
                                    @if(count($carrera))
                                    <select class="form-control" id="carrera" name="carrera" onchange="asignarNombrePortafolio(this.value)" required="">
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
                                    <b>
                                        <legend style="color:red;">
                                            No existe Carrera Registrada
                                        </legend>
                                    </b>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <br>
                                        <h3>
                                            <b>
                                                Nombre del Portafolio:
                                            </b>
                                        </h3>
                                </div>
                                <div class="form-group text-center">
                                    <input class="form-control" id="nombrePortafolio" name="nombrePortafolio" readonly="" required="" type="text" value="">

                                </div>
                                <br>
                                    <br>
                                        <div class="form-group text-center">
                                            <button class="btn btn-info btn-lg" type="submit">
                                                CREAR
                                            </button>
                                        </div>

                    </form>
                    <script type="text/javascript">
                        function asignarNombrePortafolio(valor) {
  var carrera="";
  if(valor==1)
  carrera= "PORTAFOLIO DE ING. ELECTRICA";
  if (valor==2)
    carrera="PORTAFOLIO DE ING. INDUSTRIAL";
  if(valor==3)
  carrera="PORTAFOLIO DE ING. ELECTROMECANICA"
  if (valor==4)
  carrera="PORTAFOLIO DE ING.SISTEMAS";


     document.getElementById("nombrePortafolio").value=carrera;

    }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="row box box-info">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
                    <div class="form-group text-center">
                        <h2>
                            <b>
                                Visualizar Portafolio Docente
                            </b>
                        </h2>
                    </div>
                    <div class="form-group text-center">
                        <h3>
                            Periodo Académico
                            <h3>
                            </h3>
                        </h3>
                    </div>
                    <div class="form-group text-center">
                        <!--Verificar que exista al menos un periodo Academico Registrado-->
                        @if(count($periodo))
                        <select class="form-control" id="periodoBuscar" name="periodo" onchange="buscarPortafolio()" required="">
                            <option value="{{ base64_encode('0')}}">
                                SELECCIONE PERÍODO
                            </option>
                            @foreach($periodo as $per)
                            <option value="{!!base64_encode($per->id)!!}">
                                {!! $per->desde!!} - {!! $per->hasta!!}
                            </option>
                            @endforeach
                        </select>
                        @else
                        <b>
                            <legend style="color:red;">
                                No existe Período Académico Registrado
                            </legend>
                        </b>
                        @endif
                    </div>

                    <div class="col-md-1">
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                setTimeout( "buscarPortafolio()",300);
            </script>
            <div class="row row box box-default" id="rsPortafolio">
            </div>
        </div>
    </div>
</section>
@endsection
