@extends('principal')
@section('title','Otras Actividades Portafolio')
@section('content')
  <section class="container-fluid spark-screen" >
       



<div class="box box-primary">
     
<div class="box-header text-center">
<legend><label>ACTIVIDADES DE DOCENCIA</label></legend>    
</div><!--Cierre box header-->

<div class="box-body">


  <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-2">
                                    <h4>
                                        <b>
                                            Período Académico*:
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <!--la vista cargar_materia.blade.php  ese muestra aqui en este div resultadoMateria pilas -->
                                   @if(count($periodo))

                                    <div class="form-group">
                                       

                                        <select class="form-control" required="" name="periodo" id="periodo" onchange="buscarActividad()">
                                          @foreach($periodo as $per)
                                            <option value="{{ $per->id }}">
                                            {{ $per->desde.'-'.$per->hasta }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                               @else
                                 <div class="form-group">
                                        <select class="form-control" required="" name="periodo" >
                                            <option value="0">
                                                No existen Períodos Académicos registrados
                                            </option>
                                        </select>
                                    </div>

                               @endif


                                </div>
                                <div class="col-md-4">
                                </div>


    </div><!--CIERRE ROW-->







  <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-2 ">
                <h4>
                    <b>
                        Carrera*:
                    </b>
                </h4>
            </div>
            <div class="col-md-4 form-group">
           
@if(count($carrera))           
                <select class="form-control" required="" name="carrera" id="carrera" onchange="buscarActividad()">
                @foreach($carrera as $car)
                    <option value="{{ $car->id }}">{{ $car->nombre}}</option>

                    @endforeach
                </select>

                <input id="carrera" name="" type="hidden" value="">

@else
<select class="form-control" required="" name="carrera">
    <option value="0"  >No existen Carreras Registradas</option>
</select>

@endif

            </div>

            <div class="col-md-3">
            </div>
     </div><!--Cierre row-->




<br><br>

<div class="row"> 
<div class="col-md-2"></div>
<div class="col-md-8 text-center" id="rsActividad" >
    
    
</div>
<div class="col-md-2"></div>

</div>

     <br>





</div><!--Cierre box body-->


<div class="box-footer">
    
</div>
</div><!--CIERRE DEL BOX PRIMARY-->




 </section>

<body onload="buscarActividad()"></body>
@endsection


