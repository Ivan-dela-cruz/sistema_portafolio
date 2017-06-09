@extends('principal')
@section('title','Otras Actividades Portafolio')
@section('content')
  <section class="container-fluid spark-screen" id="contenido_principal">
       

   <form action="agregar_materia_portafolio" class="form-form form_entrada" id="frm_agregar_materia_portafolio" method="post">
              <input id="portafolio" name="portafolio" type="hidden" value="">
              <input name="_token" type="hidden" value="{{ csrf_token() }}">

<div class="box box-primary">
     
<div class="box-header text-center">
<legend><label>PORTAFOLIO ACADÉMICO DOCENTE</label></legend>    
</div><!--Cierre box header-->

<div class="box-body">
 
<div  class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6 text-center" id="notificacionAgregarMateria"></div>
      <div class="col-md-3"></div>
</div>



 <div class="row">
     <div class="col-md-6">
         <div class="row">
             <div class="col-md-5 text-center"><h4><label>PERÍODO ACADÉMICO :</label></h4></div>
             <div class="col-md-7 text-center"><h4><span></span></h4></div>
         </div><!--Cerrar el row-->
     </div>
     <div class="col-md-6">
          <div class="row">
             <div class="col-md-4 text-center"><h4><label>NOMBRE: </label></h4></div>
             <div class="col-md-8 text-center"><h4><span> </span></h4></div>
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
                    <option value="">
                       
                    </option>
                </select>
                <input id="carrera" name="" type="hidden" value="">
                   
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
                                            Actividad*:
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








</div><!--Cierre box body-->


</div><!--CIERRE DEL BOX PRIMARY-->

   </form><!--CIERRE DEL FORM-->






<div class="box box-info">
    <div class="box-header text-center">
        <label>ACTIVIDAD</label></div>

<input type="hidden" name="idPorta"  id="idPorta" value="">




<!--Se actualiza nuevamente al subir archivo PDF DEL PARAMETRO-->
 
<div class="box-body" class="text-center" id="rsParametroPorta">



<table class="table" class="text-center">
<thead>
    <tr>

        <th class="text-center">PARÁMETROS</th>
       <th class="text-center">ACCIÓN</th>
    </tr>

</thead>

  

</table>
</div> <!--Cierre box body-->
</div><!--CIERRE BOX-INFO-->



    </section>
<body onload="materiasCreadas()">
</body>
@endsection


<!--<script type="text/javascript">
    setTimeout("materiasCreadas()",500);
</script>-->


<!-- Incluye el modal para subir los parametros de los portafolio-->
  @include('Docente/modalParametroPortafolio')