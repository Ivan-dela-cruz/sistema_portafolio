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
                    <a href="{{ url('parametros_asignatura/'.$mat->idMatPor) }}">
                        <img src="{{ url('imagenes/materia.png') }}">

                    </a>        
                    <br>
                        {{$mat->nombreMateria}}
                
                </div>
                
                <div class="panel-footer">
                    <a class="glyphicon glyphicon-trash" href="#">
                        <br>
                            <b style="color:red; font-size:12px">
                                Eliminar
                            </b>
                    
                    </a>
                </div>
            </div>
        </div>
        @endforeach
</div>


