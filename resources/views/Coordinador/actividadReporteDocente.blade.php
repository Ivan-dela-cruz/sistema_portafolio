@extends('principal')
@section('title','Archivos Actividades Docencia')
@section('content')
<section class="container-fluid spark-screen" >
	

<div class="box box-primary">
     
<div class="box-header text-center">
<legend><label>ACTIVIDADES DE DOCENCIA</label></legend>    
</div><!--Cierre box header-->

<div class="box-body">
 


 <div class="row">
 <input type="hidden" name="portafolio" value="{{ $idPorta }}" id="portafolio">

     <div class="col-md-5">
         <div class="row">
             <div class="col-md-6 text-center"><h4><label>PERÍODO ACADÉMICO:</label></h4></div>
             <div class="col-md-6 text-center"><h4><span>{{ $portada->inicio."-".$portada->fin }}</span></h4></div>
         </div><!--Cerrar el row-->
     </div>
     <div class="col-md-7">
          <div class="row">
             <div class="col-md-3 text-center"><h4><label>CARRERA: </label></h4></div>
             <div class="col-md-9 text-center"><h4><span>{{ $portada->carrera}}</span></h4></div>
         </div><!--Cerrar el row-->
     </div>

 </div>   <!-- cerrar primer row-->

<br>

  <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-2">
                                    <h4>
                                        <b>
                                            CATEGORÍA:
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <!--la vista cargar_materia.blade.php  ese muestra aqui en este div resultadoMateria pilas -->
                                   @if(count($categoria))

                                    <div class="form-group">
                                       

                                        <select class="form-control" required="" name="categoria" id="categoria" onchange="mostrarArchivoDirector()">
                                          @foreach($categoria as $cate)
                                            <option value="{{ $cate->id }}">
                                            {{ $cate->nombre}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                               @else
                                 <div class="form-group">
                                        <select class="form-control" required="" name="categoria" >
                                            <option value="0">
                                                No existen categorias registradas
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
                                <div class="col-md-2">
                                    <h4>
                                        <b>
                                            REPORTE:
                                        </b>
                                    </h4>
                                </div>
                                <div class="col-md-3 text-center">
                             <img src="{{ url('imagenes/Activity.png') }} " width="90px">
                             <br>
<a  href="{{url('generar_reporte_actividad/'.$idPorta ) }}"  class="btn btn-success btn-xs" target="_blank">Generar reporte actividad</a>

                                </div>
                                <div class="col-md-5">
                                </div>


</div>











</div><!--Cierre box body-->


<div class="box-footer">
    
</div>
</div><!--CIERRE DEL BOX PRIMARY-->



<div class="box box-info">
    
     <div class="box-header with-border my-box-header text-center">
        <h3 class="box-title" style="color:blue"><strong>Listado Actividades</strong></h3>
    </div><!-- /.box-header -->
   


<div class="box-body" id="rsArchivoActividad">





</div><!--Cierre box body-->


<div class="box-footer">
    


</div><!--Cierre box footer-->

</div><!--Cierre box info-->



</section>
<body onload="mostrarArchivoDirector()"></body>

@endsection

@include('Docente.modalActividad')
