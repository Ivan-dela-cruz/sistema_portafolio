    
@extends('principal')
@section('title','Asignaturas Portafolio')
@section('content')

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-title">
            <h3 >PARAMETROS PORTAFOLIO</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">

            <form method="POST">

              <label for="ingresoMarcaVehiculo" class="col-sm-2 form-control-label">ParÃ¡metro<span class="text-danger">*</span> </label>

              <div class="col-sm-10">

                <input type="text" name="ingresoMarcaVehiculo" id="ingresoMarcaVehiculo" class="form-control" required="required" placeholder="Ingresa nombre de parametro" pattern="[a-zA-ZÃ±Ã‘ÃÃ‰ÃÃ“Ãš\s]+" title="Solo puede ingresar letras">

              </div>

            </div>
            <br>
            <div class="text-right">

              <div class="col-sm-12">

                <a href="vehiculos" class="btn btn-default">Cancaler <span class="fa fa-undo"></span></a>
                <button type="submit" id="btnGuardarVehiculo" class="btn btn-success"> Agregar <span class="fa fa-check-circle"></span></button>

              </div>

            </div>

          </form>

          <table class="table table-hover">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Ordenamiento</th>
              <th>AcciÃ³n</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Silabo</td>
              <td><a href="#" class="btn btn-info">
                <span class="fa fa-arrow-up" ></span></a>
                <a class="btn btn-info"><span class="fa fa-arrow-down"></span></a></td>
              <td><a href="#" class="btn btn-success">
                <span class="fa fa-pencil" ></span></a>
                <a class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
              </tr>

            </tbody>
          </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>



    @endsection