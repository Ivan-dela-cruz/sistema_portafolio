
<table class="table table-hover">
  <h3>Periodos Registrados</h3>
  <thead>
    <tr>
      <th>Id</th>
      <th>Fecha Inicio</th>
      <th>Fecha Finalizacion</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody>
    @foreach($periodo as $per)
    <tr>

      <td>{{ $per->id }}</td>
      <td>{{ $per->desde }}</td>
      <td> {{ $per->hasta }}</td>

      <td><a href="javascript:void(0);"  data-target="#modalSubirPdf" data-toggle="modal" onclick="editParametro('{{$per->id }}', '{{ $per->desde }}')" class="btn btn-success">
        <span class="fa fa-pencil" ></span></a>
        <a href="javascript:void(0);" onclick="borrarParametro({{ $per->id }})" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

      </tr>
      @endforeach
    </tbody>
  </table>
  @include('Decano/modalDecano');
