<!DOCTYPE html>

<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="modalSubirPdf" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Subir Documentos PDF</b></h4>
        </div>
        <div class="modal-body">

         <div class="row">
         <div class="col-md-1"> </div>
         <div class="col-md-10 text-center" id="notaPdf">  

         </div>
         <div class="col-md-1"></div>
         </div>
         
         
         <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10 text-center" > 

<form  id="frm_subir_archivoPdf"  method="post"  action="subir_archivoPdf" class="formarchivo" >
<div class="form-group">
<input type="" name="documento" id="documento" >

<input type="" name="_token" id="_token" value="{!! csrf_token(); !!}">

<h4><b>Descripción:</b></h4>
  <input type="text" name="descripcion" id="descripcion" required="" class="form-control"   readonly="" required=""  >
</div>


<div class="form-group text-center">
                              <label for="apellido">Archivo a subir (Formato: PDF) </label>
                               <p class="help-block"  >Max. 5MB</p>
                              <input type="file" class="form-control" id="file" name="file" required >
</div>                         




<div class="form-group">
<script type="text/javascript">
  
function subir() {

 $("#modalSubirPdf").modal('hide');

}

</script>
  <button type="subtmit" class="btn btn-info btn-lg"  onclick="setTimeout('subir()',1500)">Guardar</button>
</div>
       
</form>

         </div>


         <div class="col-md-1"></div>
         </div>
         
    
         
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>