<div class="id-tab">
<h4 class="pull-right">(<span class="total-mat">{{$materias->total()}}</span> )<span
                class="text-primary"> materias encontradas</span>
    </h4>
    <table class="table">
        <thead class="bg-primary">
        <tr>
            <th scope="col">COD</th>
            <th class="text-center" scope="col">CARRERA</th>
            <th class="text-center" scope="col">CICLO</th>
            <th class="text-center" scope="col">NOMBRE</th>

            <th scope="col">ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        {{$materias->render()}}

        @if(count($materias))

            @foreach($materias as $materia)
                <tr class="col-mat{{$materia->id}}">
                    <td>{!! $materia->id !!}</td>
                    <td>{!! strtoupper($materia->carrera)!!}</td>
                    <td>{!! strtoupper($materia->ciclo)!!}</td>
                    <td class="text-left">{!!strtoupper( $materia->nombre)!!}</td>
                    <td>
                        <a title="Editar registro" class="btn btn-sm btn-primary"
                           href="{{ url('modificar_materia/'.$materia->id) }}">
                            Editar <span class="fa fa-pencil"></span>
                        </a>
                        <button type="button" title="Eliminar registro"
                                data-id-mat="{{$materia->id}}"
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
