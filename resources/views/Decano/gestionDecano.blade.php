
<table class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Ordenamiento</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
        @foreach($parametro as $para)
          <tr>

            <td>{{ $para->id }}</td>
            <td> {{ $para->nombre }}</td>
            <td><a href="#" class="btn btn-info">
              <span class="fa fa-arrow-up" ></span></a>
              <a class="btn btn-info"><span class="fa fa-arrow-down"></span></a></td>
              <td><a href="javascript:void(0);"  data-target="#modalSubirPdf" data-toggle="modal" onclick="editParametro('{{$para->id }}', '{{ $para->nombre }}')" class="btn btn-success">
                <span class="fa fa-pencil" ></span></a>
                <a href="javascript:void(0);" onclick="borrarParametro({{ $para->id }})" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

              </tr>
@endforeach
            </tbody>
          </table>
           @include('Decano/modalDecano');
