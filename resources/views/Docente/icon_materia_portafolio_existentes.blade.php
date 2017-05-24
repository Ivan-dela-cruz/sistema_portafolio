<br>
    <div class="row form-group">
        @foreach($materiaRegistradaPortafolio as $mat)
        <div class="col-md-3 text-center">
            <div class="panel panel-success">
               
                <div class="panel-heading">
                    <b style="color:#000000">
                        {{$mat->ciclo  }} '{{ $mat->paralelo}}'
                    </b>
                </div>

                <div class="panel-body">
                    <a title="Visualizar parametros Asignaturas " href="{{ url('parametros_asignatura/'.$mat->idMatPor) }}">
                        <img src="{{ url('imagenes/materia.png') }}">

                    </a>        
                    <br>
                        {{$mat->nombreMateria}}
                </div>
                
            </div>
        </div>
        @endforeach
</div>


