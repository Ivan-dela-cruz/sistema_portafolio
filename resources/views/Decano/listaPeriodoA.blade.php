@if(count($periodo))

<table class="table table-hover">
  <thead>
    <tr>
      <th class="text-center">Id</th>
      <th class="text-center">Fecha Inicio</th>
      <th class="text-center">Fecha Finalización</th>
      <th class="text-center">Acción</th>
    </tr>
  </thead>
  <tbody>
    @foreach($periodo as $per)
    <tr>

      <td>{{ $per->id }}</td>
      <td>{{ $per->desde }}</td>
      <td> {{ $per->hasta }}</td>

      <td><a href="javascript:void(0);" title="Modificar Período Académico"  data-target="#modalActualizarPeriodo" data-toggle="modal" onclick="editPeriodo('{{$per->id }}', '{{ $per->desde }}','{{  $per->hasta}}')" class="btn btn-info">
        <span class="fa fa-pencil" ></span></a>
  </td>

      </tr>
      @endforeach
    </tbody>
  </table>

@else

  <div class="alert alert-warning text-center">

        <label >
       No existen Períodos Académicos Registrados</label>
         </div>
@endif
