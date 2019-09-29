<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-user"></i> <span>Administrador</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="active"><a href="{{ url('gestion_periodo') }}"><i class="fa fa-circle-o"></i>Periodo. </a></li>
    </ul>

    <ul class="treeview-menu">
        <li class="active"><a href="{{ url('/gestion_parametro') }}"><i class="fa fa-circle-o"></i>Parametro. </a></li>
    </ul>
    <ul class="treeview-menu">
        <li class="active"><a href="{{url('listado_usuario')}}"><i class="fa fa-circle-o"></i>Asignar Rol Usuario. </a>
        </li>
    </ul>
    <ul class="treeview-menu">
        <li class="active"><a href="{{url('crear_materia')}}"><i class="fa fa-circle-o"></i>Agreagar asignatura</a>
        </li>
    </ul>
    <ul class="treeview-menu">
        <li class="active"><a href="{{url('modificar_subida_documentos')}}"><i class="fa fa-circle-o"></i>Tiempo de eliminación</a>
        </li>
    </ul>


</li>

          
