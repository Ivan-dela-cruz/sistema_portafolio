<table class="table" class="text-center">
    <thead>
    <tr>

        <th class="text-center">PARÁMETROS</th>
        <th class="text-center">ACCIÓN</th>
    </tr>

    </thead>

    @foreach($parametrosPorta as $paraPorta)
        <tr>
            <td class="text-center"><br> <b style="font-size:13px"> {{ $paraPorta->parametro }} </b></td>
            @if($paraPorta->urlArchivo)
                <td class="text-center"><a title="Visualizar archivo Pdf" href="{{url($paraPorta->urlArchivo)}}"
                                           target="_blank"> <img src="{{url('imagenes/pdf2.png')}}"
                                                                 style="width:50px; height:50px;"></a>
                    <br>
                    @if($tiempoTares->fecha_fin_portada >= $hoy->toDateString() && $tiempoTares->hora_fin_portada >= $hoy->toTimeString())


                        <a href="javascript:void(0);"
                           onclick="eliminarArchivoParametroPortaDocente('{{$paraPorta->id }}')"
                           title="Eliminar Archivo " class="btn btn-danger"><span
                                    class="fa fa-trash"></span></a>

                        <a class="btn btn-success" title="Descargar Archivo"
                           href="{{ url('descargar_pdf_Porta/'.$paraPorta->id) }}"><span
                                    class="glyphicon glyphicon-save"> </span></a>

                    @else
                        <a class="btn btn-success" title="Descargar Archivo"
                           href="{{ url('descargar_pdf_Porta/'.$paraPorta->id) }}"><span
                                    class="glyphicon glyphicon-save"> </span></a>
                    @endif


                </td>
            @else
                <td class="text-center">
                    <a title="No existe Archivo" href="javascript:void(0);"><img src="{{ url('imagenes/pdf.png')}}"
                                                                                 style="width:45px; height:55px" ;> </a>
                    <br>
                    <button class="btn btn-primary btn-xs" data-target="#modalSubirParametroPorta" data-toggle="modal"
                            onclick="getIdParametro3('{{$paraPorta->id }}', '{{ $paraPorta->parametro }}')"
                            type="button">
                                        <span class="glyphicon glyphicon-open">
                                            _Subir
                                        </span>
                    </button>

                </td>
            @endif

        </tr>
    @endforeach

</table>
