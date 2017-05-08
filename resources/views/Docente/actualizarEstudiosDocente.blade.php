                            @foreach($nivel as $nv)
                            <li class="list-group-item">
                                <i class="fa fa-book margin-r-5">
                                </i>
                                <b>
                                    --{{ $nv->nombre }} Nivel
                                </b>
                                <a class="pull-right">
                                </a>
                                <!--  variable del controlador del de  la relacion de unos a muchos se en cuentra el metos en Modelo users-->
                                @foreach($titulo->get() as $titu)
                                <!-- Pra claasificar segun la categoria-->
                                @if($titu->idNivel==$nv->id)
                                <br/>
                                <i class="fa fa-circle-o text-yellow">
                                </i>
                                <span class="text-light-blue">
                                    -{{$titu->nombre }}
                                </span>
                                <span>
                                    --   {!! $titu->fechaRegistro  !!}
                                </span>
                                <span>
                                    --  {!! $titu->codigoRegistro !!}
                                </span>
                                <span class="tools pull-right">
                                    <a href="javascript:void(0);" onclick="borrarTitulo({{ $titu->id }})">
                                        <i class="fa fa-trash-o">
                                        </i>
                                    </a>
                                </span>
                                @endif
        @endforeach
                            </li>
                            @endforeach