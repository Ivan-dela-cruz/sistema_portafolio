<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
</meta>
</meta>
</head>
<body>

    <div class="container">



<script type="text/javascript">
  
  function obtenerFechaInicio2() {
var fecha=document.getElementById("fechaInicio2").value;
var elem= fecha.split('-');
 var anio = elem[0];
var mes=elem[1];
var nombreMes="";
if (mes=="01") {nombreMes="Enero";}
if (mes=="02") {nombreMes="Febrero";}
if (mes=="03") {nombreMes="Marzo";}
if (mes=="04") {nombreMes="Abril";}
if (mes=="05") {nombreMes="Mayo";}
if (mes=="06") {nombreMes="Junio";}
if (mes=="07") {nombreMes="Julio";}
if (mes=="08") {nombreMes="Agosto";}
if (mes=="09") {nombreMes="Septiembre";}
if (mes=="10") {nombreMes="Octubre";}
if (mes=="11") {nombreMes="Noviembre";}
if (mes=="12") {nombreMes="Diciembre";}

document.getElementById("mes_anio_inicio2").value=  nombreMes+"_"+anio;
//alert(mes);
  }





  function obtenerFechaFin2() {
var fecha=document.getElementById("fechaFin2").value;
var elem= fecha.split('-');
 var anio = elem[0];
var mes=elem[1];
var nombreMes="";
if (mes=="01") {nombreMes="Enero";}
if (mes=="02") {nombreMes="Febrero";}
if (mes=="03") {nombreMes="Marzo";}
if (mes=="04") {nombreMes="Abril";}
if (mes=="05") {nombreMes="Mayo";}
if (mes=="06") {nombreMes="Junio";}
if (mes=="07") {nombreMes="Julio";}
if (mes=="08") {nombreMes="Agosto";}
if (mes=="09") {nombreMes="Septiembre";}
if (mes=="10") {nombreMes="Octubre";}
if (mes=="11") {nombreMes="Noviembre";}
if (mes=="12") {nombreMes="Diciembre";}

document.getElementById("mes_anio_fin2").value=  nombreMes+"_"+anio;
//alert(mes);
  }
</script>
    <!-- Modal -->

    <div class="modal fade" id="modalActualizarPeriodo" role="dialog">
        <div class="modal-dialog modal-xs ">
            <div class="modal-content">

                <div class="modal-header text-center">
                    <button class="close" data-dismiss="modal" onclick="limpiarModalP()" type="button">
                        ×
                    </button>
                    <h4 class="modal-title">
                        <b>
                            Editar Período Académico
                        </b>
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10 text-center" id="notaPeriodo">

                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10 text-center">
                            <form action="actualizar_periodo" class="form_entrada" id="frm_periodo" method="post">
                                <div class="form-group">

                                  
                                  <input class="text-center" id="idPeriodo" name="idPeriodo" type="hidden" readonly="" required="">
                                  <!--  El doque a enviar-->
                                  <input id="_token" name="_token" type="hidden" value="{!! csrf_token(); !!}">
                   
                            


  <div class="row">

    <div class="col-md-12">
<div class="row">
  <div class="col-md-4 text-left"><h4><label>Fecha Inicio<span class="text-danger">*</span> </label></h4> </div>
<div class="col-md-8"><h4><input name="inicio" id="fechaInicio2" required="" type="month" onchange="obtenerFechaInicio2()"  class="form-control"> </h4></div>
</div>
    </div>

  </div><!--cierre row-->
  <div class="row">

    <div class="col-md-12">
     <div class="row">
       <div class="col-md-4">
     <h4><label>Fecha Fin<span class="text-danger">*</span> </label></h4>
       </div>
      <div class="col-md-8">
        <h4><input type="month"  name="fin" id="fechaFin2" required=""  onchange="obtenerFechaFin2()" class="form-control"> </h4>

      </div>
     </div>

    </div>
  </div><!--cierre row-->








 <div class="row">
     <div class="col-md-6">
     <h4><input type="hidden" readonly="" name="mes_anio_inicio2" id="mes_anio_inicio2" class="form-control"></h4>
    </div>
<div class="col-md-6">
     <h4><input type="hidden" readonly="" name="mes_anio_fin2" id="mes_anio_fin2" class="form-control"></h4>
    </div>
  </div>







                            </div>

                           <div class="form-group">
                                <button class="btn btn-success " type="subtmit" >
                                    <span class="glyphicon glyphicon-saved">
                                        Actualizar
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" type="button" onclick="limpiarModalP()">
                    Cerrar
                </button>




            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function limpiarModalP(){
        //Limpia el mensaje que aparece ala subir pdf
        document.getElementById("notaPeriodo").innerHTML="";
 //Limpia el formulario
 $('#frm_periodo').trigger("reset");

}

</script>


</body>
</html>