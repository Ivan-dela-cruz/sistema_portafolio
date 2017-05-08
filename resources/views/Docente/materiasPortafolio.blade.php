@extends('principal')
@section('title','Asignaturas Portafolio')
@section('content')
  <section class="container-fluid spark-screen" id="contenido_principal">
       

   <form action="agregar_materia_portafolio" class="form-form form_entrada" id="frm_agregar_materia_portafolio" method="post">
              <input id="portafolio" name="portafolio" type="hidden" value="{{ $idPortafolioActual }}">
              <input name="_token" type="hidden" value="{{ csrf_token() }}">

<div class="box box-primary">
     
<div class="box-header text-center">
<legend><label>PORTAFOLIO ACADÉMICO DOCENTE</label></legend>    
</div><!--Cierre box header-->

<div class="box-body">
 <div class="row">
     <div class="col-md-6">
         <div class="row">
             <div class="col-md-5 text-center"><h4><label>PERÍODO ACADÉMICO :</label></h4></div>
             <div class="col-md-7 text-center"><h4><span>{!! $periodoActual->desde!!}-{!!$periodoActual->hasta!!}</span></h4></div>
         </div><!--Cerrar el row-->
     </div>
     <div class="col-md-6">
          <div class="row">
             <div class="col-md-4 text-center"><h4><label>NOMBRE: </label></h4></div>
             <div class="col-md-8 text-center"><h4><span> {!! $nombrePortafolio!!}</span></h4></div>
         </div><!--Cerrar el row-->
     </div>


 </div>   <!-- cerrar primer row-->



  <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-1 ">
                <h4>
                    <b>
                        Carrera*:
                    </b>
                </h4>
            </div>
            <div class="col-md-5 form-group">
           
                <select class="form-control" required="">
                    <option value="{{ $carreraActual->id }}">
                        {{$carreraActual->nombre}}
                    </option>
                </select>
                <input id="carrera" name="" type="hidden" value="{{ $carreraActual->id }}">
                   
            </div>




            <div class="col-md-3">
            </div>

     </div><!--Cierre row-->






      <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-1">
                                    <h4>
                                        <b>
                                            Ciclo*:
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-2 form-group">
                                    <select class="form-control" name="" onchange="cargarMateria(this.value)" required="">
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
                                <div class="col-md-1">
                                    <h4>
                                        <b>
                                            Paralelo*:
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-2">
                                    @if(count($paralelo))
                                    <select class="form-control" name="paralelo" required="">
                                        <option value="">
                                            Seleccione Paralelo
                                        </option>
                                        @foreach($paralelo as $para)
                                        <option value="{{ $para->id }}">
                                            {{$para->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                    <select class="form-control" required="">
                                        <option value="">
                                            No existen Paralelos
                                        </option>
                                    </select>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div><!--Cierre row-->




  <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-1">
                                    <h4>
                                        <b>
                                            Materia*:
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <!--la vista cargar_materia.blade.php  ese muestra aqui en este div resultadoMateria pilas -->
                                    <div class="form-group" id="resultadoMateria">
                                        <select class="form-control" required="">
                                            <option value="">
                                                --NINGÚNA--
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                </div>


    </div><!--CIERRE ROW-->




<div class="row form-group">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                                        Agregar Asignaturas
                                    </button>
                                </div>
                                <div class="col-md-4">
                                </div>
</div><!--cierra ultimo-->




</div><!--Cierre box body-->


</div><!--CIERRE DEL BOX PRIMARY-->

   </form><!--CIERRE DEL FORM-->


<div class="box box-info">
    <div class="box-header text-center"><label>PARÁMETROS PORTAFOLIO</label></div>

</div>








<div class="box box-success">
    
<div class="box-header text-center">
<label>ASIGNATURAS REGISTRADAS EN EL PORTAFOLIO</label>    
</div>
<div class="box-body text-center"  id="notificacionAgregarMateria">
    
                    <button class="btn btn-success" onclick="materiasCreadas()" type="button">
                        <span class="glyphicon glyphicon-eye-open">
                        </span>
                    </button>
</div> <!--Cierre box-body-->

</div> <!-- Cierre del box success-->







    </section>

@endsection
<body onload="materiasCreadas()">
    

</body>

<!--<script type="text/javascript">
    setTimeout("materiasCreadas()",500);
</script>-->
