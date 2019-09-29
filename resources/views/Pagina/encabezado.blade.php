<header class="main-header">

    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P.A</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg "><b>Portafolio</b> Académico</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url($fotoUser) }}" alt="User Image" class="img-circle"
                             style="width:20px;height:20px;">
                        <span class="hidden-xs"> {{ Auth::user()->usuario }} <span class="caret"></span>
                  </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <img src="{{url($fotoUser)}}" class="img-circle" alt="User Image"
                                 style="width:50px;height:50px;">
                            <p>
                                <!--Asignar rol-->
                                @foreach(Auth::user()-> getNameRole() as $roles)
                                {!! $roles."," !!}
                                @endforeach

                                </b>


                                </legend>
                                <small> <?php echo date("d-M-Y"); ?></small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('editar_perfil_docente')}}" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Salir </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>

                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Ayuda<i class="fa fa-question-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-footer">


                            @role('docente')
                            <h3>Manual de Usuario</h3>
                            @else
                                @role('director')
                                <h3>Manual de Usuario</h3>
                                @else
                                    @role('vicedecano')
                                    <h3>Manual de Usuario</h3>
                                    @else
                                        <h3>Usuario Invitado</h3>
                                        @endrole
                                        @endrole
                                        @endrole


                        </li>
                        <li class="user-body">
                            @role('docente')
                            <a target="_blank" class="glyphicon glyphicon-book"
                               href="{{ url('manual/manualDocente.pdf') }}">&nbsp;<b>Manual Docente</b></a>
                            @endrole
                            @role('director')
                            <a target="_blank" class="glyphicon glyphicon-book"
                               href="{{url('manual/manualDirector.pdf')}} ">&nbsp;<b>Manual Director</b></a>
                            @endrole
                            @role('vicedecano')
                            <a target="_blank" class="glyphicon glyphicon-book"
                               href="{{url('manual/manualDecano.pdf')}}">&nbsp;<b>Manual Vicedecano</b></a>
                            @endrole

                            @role('docente')
                            <b></b>
                            @else
                                @role('director')
                                <b></b>
                                @else
                                    @role('vicedecano')
                                    <b></b>
                                    @else
                                        <span class="fa fa-info"><h5 style="color:red;">Pongase en contacto con el administrador para que se le asignen privilegios.</h5>
      </span>
                                        @endrole
                                        @endrole
                                        @endrole
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
    </nav>
</header>
