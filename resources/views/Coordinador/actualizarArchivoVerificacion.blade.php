@foreach($productosAcademico as $prodAca)

    <div class="box-header text-center">
        <legend><label><b> PARÁMETROS {{ $prodAca->nombre }}</b> </label></legend>
    </div>

    <div class="box-body">


        @php
            $cont=0;
        @endphp



        @foreach($parametrosProducto as $paraProd)

            @if($prodAca->id==$paraProd->idProAca)

                @php$cont++ @endphp
                @if($cont==1)
                    <div class="row from-group">
                        @endif
                        <div class="col-md-3 text-center form-group">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="modal-title">
                                        <b style="font-size:13px">
                                            {{ $paraProd->nombre }}
                                        </b>
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    @if($paraProd->urlArchivo)
                                        <a href="{{url($paraProd->urlArchivo)}}" title="Visualizar archivo"
                                           target="_blank"> <img src="{{url('imagenes/pdf2.png')}}"
                                                                 style="width:50px; height:50px;"></a>


                                        <br>
                                        @php

                                            $date2 = new DateTime($paraProd->updated_at);
                                            //$fecha=  $date->format('Y-m-d H:i:s');

                                            $fecha2=  $date2->format('Y-m-d');
                                            //$fecha=date("d-m-Y (H:i:s)", $date);


                                        @endphp

                                        <label> {{ $fecha2 }}</label>


                                    @else
                                        <a href="javascript:void(0);" title="No existe Archivo"><img
                                                    src="{{ url('imagenes/pdf.png')}}" style="width:45px; height:55px"
                                                    ;> </a>
                                    @endif

                                </div>


                                <div class="panel-footer">
                                    @if(!$paraProd->urlArchivo)

                                        <b> <span>
                                            No existe 
                                        </span></b>

                                    @else



                                        <a href="javascript:void(0);" onclick="eliminarArchivo('{{$paraProd->id }}')"
                                           title="Eliminar Archivo " class="btn btn-danger"><span
                                                    class="fa fa-trash"></span></a>

                                        <a class="btn btn-success" title="Descargar Archivo"
                                           href="{{ url('descargar_pdf/'.$paraProd->id) }}"><span
                                                    class="glyphicon glyphicon-save"> </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($cont==4)
                    </div>
                    @php $cont=0 @endphp
                @endif
            @endif
        @endforeach
    </div> <!--Cierre caja body-->

@endforeach
