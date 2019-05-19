<table class="table" class="text-center">
    <thead>
    <tr>

        <th class="text-center">PARÁMETROS</th>
        <th class="text-center">ACCIÓN</th>
    </tr>

    </thead>

    @foreach($parametroPortafolio as $paraPorta)
        <tr>
            <td class="text-center"><br> <b style="font-size:13px"> {{ $paraPorta->parametro }} </b></td>
            @if($paraPorta->urlArchivo)





                <td class="text-center">


                    <a title="Visualizar archivo Pdf" href="{{url($paraPorta->urlArchivo)}}" target="_blank"> <img
                                src="{{url('imagenes/pdf2.png')}}" style="width:50px; height:50px;"></a>
                    <br>
                    @php

                        $date = new DateTime($paraPorta->updated_at);
                        //$fecha=  $date->format('Y-m-d H:i:s');

                        $fecha=  $date->format('Y-m-d');
                        //$fecha=date("d-m-Y (H:i:s)", $date);


                    @endphp

                    <label> {{ $fecha }}</label> <br>
                    <a href="javascript:void(0);" onclick="eliminarArchivoParametroPorta('{{$paraPorta->id }}')"
                       title="Eliminar Archivo " class="btn btn-danger"><span class="fa fa-trash"></span></a>

                    <a class="btn btn-success" title="Descargar Archivo"
                       href="{{ url('descargar_pdf_Porta/'.$paraPorta->id) }}""><span
                            class="glyphicon glyphicon-save"> </span>


                    </a>
                </td>
            @else
                <td class="text-center">
                    <a title="No existe Archivo" href="javascript:void(0);"><img src="{{ url('imagenes/pdf.png')}}"
                                                                                 style="width:45px; height:55px" ;> </a>
                    <br>
                    <b> <span>
                                            No existe 
                                        </span></b>

                </td>
            @endif

        </tr>
    @endforeach

</table>
