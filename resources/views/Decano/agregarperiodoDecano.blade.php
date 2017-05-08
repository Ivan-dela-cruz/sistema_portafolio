@extends('principal')
@section('title','Parametros Portafolio')
@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
     <div class="box-title">
      <h3 >Añadir Periodo</h3>
    </div><!-- /.box-header -->
    <br>
    <div class="box-body">


      <form action="crear_periodo" class="form-horizontal form_entrada" id="frm_crear_periodo" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <label  class="col-sm-2 form-control-label">Fecha Inicio<span class="text-danger">*</span> </label>

        <div class="col-sm-10">

          <input  type="text" name="desdePeriodo" id="desdePeriodo" class="form-control" required="required" pattern="[a-zA-ZÃ±Ã‘ÃÃ‰ÃÃ“Ãš\s]+" title="Solo puede ingresar letras" placeholder="Ingresa fecha" >

        </div>
        <br><br><br>
        <label  class="col-sm-2 form-control-label">Fecha Fin<span class="text-danger">*</span> </label>

        <div class="col-sm-10">

          <input  type="text" name="hastaPeriodo" id="hastaPeriodo" class="form-control" required="required" pattern="[a-zA-ZÃ±Ã‘ÃÃ‰ÃÃ“Ãš\s]+" title="Solo puede ingresar letras" placeholder="Ingresa fecha" >

        </div>
        <div class="text-right">

          <div class="col-sm-12">
            <br>
            <a href="{{ url('/gestion_periodo') }}" class="btn btn-default">Cancelar <span class="fa fa-undo"></span></a>
            <button type="submit" id="" class="btn btn-success"> Agregar <span class="fa fa-check-circle"></span></button>

          </div>

        </div>
      </div>

    </div>
  </div>
  <br>

</form>
<br>
<br>
<br>

<div class="col-xs-12">
  <div class="box box-primary">
    <div class="text-center " id="notificacion_crear_parametro">
      <br>
      <button class="btn btn-primary" onclick="periodosCreados()" type="button">
        <span class="fa fa-eye fa-lg">
        </span>
      </button>
      <br>
      <br>

    </div>


  </div>
</div>



@endsection
<script type="text/javascript">
  setTimeout("periodosCreados()",500);
</script>
