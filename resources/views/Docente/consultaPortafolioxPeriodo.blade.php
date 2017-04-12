
  
  
  <div class="col-md-12">
    <br>
  @if(!count($portafolios))
  <div align="center" class="form-group ">
   <b> <legend style="color:#6A0888;">Favor crear su  portafolio</legend> </b>  
  </div>
  @else

  @php 
  $cont=0;
  @endphp

  <table class="table" style="width: 100%;">
  <tr>
  @foreach($portafolios as $porta)
  <th>

  <div class="panel panel-primary"  >
      <div class="panel-heading text-center">
      <b style="font-size:11px;">{{ $porta->nombre }}</b>
      </div>

    <div class="panel-body text-center">
  

  <!--<a onclick="contenidoPortafolio({!! $porta->id !!});" href="javascript:void(0);"> 
  <img style="height:60px" src="{{ url('imagenes/Portafolios.png') }}"></a> 
-->
<a href="{!! url('materias_portafolio/'.$porta->id) !!}"><img style="height:60px" src="{!!url('imagenes/Portafolios.png')!!}"></a>

   <input type="hidden" value="{{$porta->id}}" id="idPortafolio" name="idPortafolio">   
    </div>

    </div>
  </th>
  @php
  $cont++;
  @endphp

  @if($cont==2)
  </tr><tr>
  @php $cont=0; @endphp
  @endif
  @endforeach

  </tr>
  </table>

  @endif



  </div>


