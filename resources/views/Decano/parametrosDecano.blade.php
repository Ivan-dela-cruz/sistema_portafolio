@extends('principal')
@section('title','Parametros Portafolio')
@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
     <div class="box-title">
      <h3 >PARAMETROS PORTAFOLIO</h3>
    </div><!-- /.box-header -->
    <br>
    <div class="box-body">


      <form action="crear_parametro" class="form-horizontal form_entrada" id="frm_crear_parametro" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <label for="ingresoMarcaVehiculo" class="col-sm-2 form-control-label">Parametro<span class="text-danger">*</span> </label>

        <div class="col-sm-10">

          <input  type="text" name="nombreParametro" id="nombreParametro" class="form-control" required="required" placeholder="Ingresa nombre de parametro" pattern="[a-zA-ZÃ±Ã‘ÃÃ‰ÃÃ“Ãš\s]+" title="Solo puede ingresar letras">

        </div>
        <div class="text-right">

          <div class="col-sm-12">
            <br>
            <a href="{{ url('/gestion_parametro') }}" class="btn btn-default">Cancaler <span class="fa fa-undo"></span></a>
            <button type="submit" id="btnGuardarVehiculo" class="btn btn-success"> Agregar <span class="fa fa-check-circle"></span></button>

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
      <button class="btn btn-primary" onclick="parametrosCreados()" type="button">
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
  setTimeout("parametrosCreados()",500);
</script>
