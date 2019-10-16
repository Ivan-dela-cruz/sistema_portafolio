<div class="id-tab">
    @if (count($insumos))
        @foreach($insumos as $insumo)
            <div class="col-lg-12 text-left">
                <h3>
                    {{$insumo->titulo}}
                </h3>
                <p>
                    Publicado el
                    {{ $insumo->created_at->formatLocalized('%A %d %B %Y')}}
                    por el Administrador [ actualizado el,
                    {{$insumo->updated_at->formatLocalized('%A %d %B %Y')}} ]

                </p>
                <p>Archivos adjuntos:</p>
            </div>
            @if ($insumo->url_pdf!='')
                <div class="col-lg-4 text-left">
                    <span>
                        <img height="35" width="35" src="{{asset('imagenes/pdf2.png')}}" alt="">
                        <a href="">{{substr($insumo->url_pdf,28)}}</a>
                    </span>
                </div>
            @endif
            @if ($insumo->url_doc!='')
                <div class="col-lg-4 text-left">
                    <span>
                        <img height="35" width="35" src="{{asset('imagenes/doc.png')}}" alt="">
                        <a href="">{{substr($insumo->url_doc,28)}}</a>
                    </span>
                </div>
            @endif
            @if ($insumo->url_xls!='')
                <div class="col-lg-4 text-left">
                    <span>
                        <img height="35" width="35" src="{{asset('imagenes/xls.png')}}" alt="">
                        <a href="">{{substr($insumo->url_xls,28)}}</a>
                    </span>
                </div>
            @endif
            <div class="col-lg-12 text-left">
                <hr class="bg-danger">
            </div>
        @endforeach

    @else
    <!--Si no existe periodo academico registrado-->
        <h4 value="">
            No existe Período Académico Registrado
        </h4>
    @endif
</div>
