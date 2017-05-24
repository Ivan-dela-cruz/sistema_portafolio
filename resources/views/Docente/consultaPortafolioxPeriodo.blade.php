<div class="row">

    <div class="col-md-12">
        @if(!count($portafolios))
        <div class="alert alert-warning text-center">
        <label>Portafolio no creado para el Período seleccionado</label>
            </div>

        @else

<div class="row">
@foreach($portafolios as $porta)

<div class="col-md-6"> 
                <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <b style="font-size:11px;">
                                {{ $porta->nombre }}
                            </b>
                        </div>
                        <div class="panel-body text-center">
                            <!--<a onclick="contenidoPortafolio({!! $porta->id !!});" href="javascript:void(0);"> 
  <img style="height:60px" src="{{ url('imagenes/Portafolios.png') }}"></a> 
-->
                            <a href="{!! url('materias_portafolio/'.$porta->id) !!}">
                                <img src="{!!url('imagenes/Portafolios.png')!!}" style="height:60px"/>
                            </a>
                            <input id="idPortafolio" name="idPortafolio" type="hidden" value="{{$porta->id}}">
                            </div>
                    </div>
</div>
       
@endforeach

</div>

        @endif

    </div>
   
</div>




