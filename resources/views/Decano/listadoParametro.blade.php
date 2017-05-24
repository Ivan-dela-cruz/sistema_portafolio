@if(count($tipoParametros))

  <div class="box-header text-center">
    <b>ORDEN DEL PORTAFOLIO ACADÉMICO</b>
  </div>
  
  

  <div class="box-body" > 
  <div class="table-responsive">
  <table class="table">

   <tr> <th class="text-center">Id</th>
    <th class="text-center">Nombre</th>
    <th class="text-center">Ordenamiento</th>
    <th class="text-center">Acción</th>
    </tr>

  @foreach($tipoParametros as $tipParametro)
  <tbody>
  @if($tipParametro->id==1)
  <tr><th colspan="4" class="text-center" ><b>Portada General {{ $tipParametro->nombre }}</b></th></tr>
  @else
 <tr><th colspan="4" class="text-center" ><b>Párametros {{ $tipParametro->nombre }}</b></th></tr>
  @endif

    @foreach($parametro as $para)
    @if($tipParametro->id==$para->idTipPar)
    <tr>
           <td class="text-center">{{ $para->id }}</td>
            <td class="text-center"> {{ $para->nombre }}</td>
            <td class="text-center"><a href="#" class="btn btn-info">
              <span class="fa fa-arrow-up" ></span></a>
              <a class="btn btn-info"><span class="fa fa-arrow-down"></span></a></td>
              <td class="text-center"><a href="javascript:void(0);"  data-target="#modalActualizarParametro" data-toggle="modal" onclick="editParametro('{{$para->id }}', '{{ $para->nombre }}')" class="btn btn-success">
                <span class="fa fa-pencil" ></span></a>
                <a href="javascript:void(0);" onclick="borrarParametro({{ $para->id }})" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
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