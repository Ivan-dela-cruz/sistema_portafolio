@extends('principal')
@section('title','Parametros Portafolio')
@section('content')


<div class="box box-primary">
  <div class="box-header text-center">
    <legend><label>CREAR PARÁMETROS PORTAFOLIO ACADÉMICO </label></legend>
  </div>
<div class="box-body">
  
      <form action="crear_parametro" class="form-horizontal form_entrada" id="frm_crear_parametro" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">


<div class="row">
<div class="col-md-12">
    <div class="text-center " id="notificacion_crear_parametro"></div>
</div>
</div>




<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-5 text-center"><h4><label>PARÁMETROS<span class="text-danger">*</span> </label></h4></div>
      <div class="col-md-7">  
@if(count($tipoParametros))     
      <select class="form-control" name="tipo_parametro"> 
    @foreach($tipoParametros as $tipPar )
       <option value="{{ $tipPar->id }}"> {{ $tipPar->nombre }}</option>
      @endforeach

      </select> 
      @else
   <select required="" name="tipo_parametro" class="form-control"> 
     <option value=""> No existen tipos parámetros </option>
   </select>
      @endif

      </div>
      <!--Cierre col-md-8-->
    </div>

  </div>
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-6 text-center"> 
       <h4> <label>NOMBRE PARÁMETRO<span class="text-danger">*</span> </label></h4>
       </div>
       <div class="col-md-6">
        <input  type="text" name="nombre_parametro" id="nombre_parametro" class="form-control" required="" placeholder="Ingresa nombre del parámetro" >
       </div> <!--Cierer col 8-->
    </div> <!--Cierer del row-->

  </div>

<div class="col-md-1"></div>
</div> <!--Cierre del row-->

<div class="row">
  
  <div class="col-md-1"></div>
<div class="col-md-10 text-right" >
            <br>
            <a href="{{ url('/gestion_parametro') }}" class="btn btn-default">Cancaler <span class="fa fa-undo"></span></a>
            <button type="submit" class="btn btn-success"> Agregar <span class="fa fa-check-circle"></span></button>

          </div>
<div class="col-md-1"></div>

</div>
</form>
</div> <!--Cierre box body-->

<div class="box-footer"> </div>

</div> <!--Cierre box-->






<div class="box box-success" id="rsListaParametro">
@if(count($tipoParametros))

  <div class="box-header text-center">
    <b>ORDEN DEL PORTAFOLIO ACADÉMICO</b>
  </div>
  
  

  <div class="box-body" > 
  <div class="table-responsive">
  <table class="table">

   <tr> <th class="text-center">Id</th>
    <th class="text-center">Nombre</th>
    
    <th class="text-center">Acción</th>
    </tr>

  @foreach($tipoParametros as $tipParametro)
  <tbody>
  @if($tipParametro->id==1)
  <tr><th colspan="4" class="text-center" ><b>PORTADA GENERAL {{ $tipParametro->nombre }}</b></th></tr>
  @else
 <tr><th colspan="4" class="text-center" ><b>PARÁMETROS {{ $tipParametro->nombre }}</b></th></tr>
  @endif

    @foreach($parametro as $para)
    @if($tipParametro->id==$para->idTipPar)
    <tr>
           <td class="text-center">{{ $para->id }}</td>
            <td class="text-center"> {{ $para->nombre }}</td>
            
              <td class="text-center"><a href="javascript:void(0);"  data-target="#modalActualizarParametro" data-toggle="modal" onclick="editParametro('{{$para->id }}', '{{ $para->nombre }}')" class="btn btn-success">
                <span class="fa fa-pencil" ></span></a>
                </td>
    </tr>
    @endif
@endforeach<!--Cierre segundo foreach-->
  </tbody>

@endforeach

  </table>

</div><!-- Cierre box body-->
   </div>

@else

  <div class="alert alert-warning text-center">

        <label >
       No existen Parámetros Registrados</label>
         </div>

@endif

</div><!--Cierre box succes-->
   @include('Decano/modalParametro')
@endsection

