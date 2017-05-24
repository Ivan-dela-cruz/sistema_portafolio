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

    <div class="modal fade" id="modalActualizarParametro" role="dialog">
        <div class="modal-dialog modal-xs ">
            <div class="modal-content">

                <div class="modal-header text-center">
                    <button class="close" data-dismiss="modal" onclick="limpiarModalPa()" type="button">
                        ×
                    </button>
                    <h4 class="modal-title">
                        <b>
                            Editar Parámetros Portafolio
                        </b>
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10 text-center" id="notaParametro">

                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            <form action="actualizar_parametro" class="form_entrada" id="frm_parametro" method="post">
                                <div class="form-group">

                                  
                                  <input class="text-center" id="idParametro" name="idParametro" type="hidden" readonly="" required="">
                                  <!--  El doque a enviar-->
                                  <input id="_token" name="_token" type="hidden" value="{!! csrf_token(); !!}">
                  

                                 </div>
    
                      <div class="form-group text-center">
    
                        <b>NOMBRE PARÁMETRO</b>
<br><br>
                         <input type="" name="nombreParametro" id="nombreParametro"  class="form-control">
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
                    <div class="col-md-2">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" type="button" onclick="limpiarModalPa()">
                    Cerrar
                </button>




            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function limpiarModalPa(){
        //Limpia el mensaje que aparece ala subir pdf
        document.getElementById("notaPeriodo").innerHTML="";
 //Limpia el formulario
 $('#frm_periodo').trigger("reset");

}

</script>


</body>
</html>