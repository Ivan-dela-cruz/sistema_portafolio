<div class="id-tab">
    <table class="table">
        <thead class="bg-primary">
        <tr>
            <th class="text-center" scope="col">NOMBRE</th>
            <th class="text-center" scope="col">ACCIONES</th>
        </tr>
        </thead>
        <tbody>

        @if(count($productos))

            @foreach($productos as $producto)
                <tr class="col-mat{{$producto->id}}">
                    <td>{!! strtoupper($producto->nombre)!!}</td>
                    <td>
                        <button type="button" title="Editar registro"
                                data-id-pro="{{$producto->id}}"
                                data-nombre="{{$producto->nombre}}"
                                class="btn btn-sm btn-primary btn-edit">
                            Editar <span class="fa fa-pencil"></span>
                        </button>
                        <button type="button" title="Eliminar registro"
                                data-id-pro="{{$producto->id}}"
                                class="btn btn-sm btn-danger btn-delete">
                            Borrar <span class="fa fa-trash"></span>
                        </button>
                    </td>
                </tr>

            @endforeach


        @else
            <!--Si no existe periodo academico registrado-->

            <h4 value="">
                No existe Período Académico Registrado
            </h4>


        @endif

        </tbody>
    </table>
</div>
