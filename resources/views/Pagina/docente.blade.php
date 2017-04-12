<div class="container">
      <div class="row" >
           <div class="col-sm-4 " align="center">
            <a href="{{ url('consultar_portafolio') }}" ><img align="center" src="{{url('imagenes/logoportafolio.png')}}"  style="height:70%; width: 70%;" > </a>
            <br>
        </div>
          <div class="col-sm-4" align="center" >
          <a href="{!!url('editar_perfil_docente')!!}" ><img align="center" src="{{ url('imagenes/logoperfil.png') }}" style="height: 180px; width: 180px;" > </a>
              <br>

            </div>


<a href="{{ url('lista_docente')}}">Docentes</a>

<a href="{{ url('reporte') }}">Reportes</a>

      </div>

  <div class="row">
    <div class="col-sm-4" align="center">
    <h3><span class="label label-primary">Portafolio Docente</span></h3>
    </div>
    <div class="col-sm-4" align="center">
      <h3><span class="label label-primary">Perfil Docente</span></h3>
    </div>
  </div>
</div>