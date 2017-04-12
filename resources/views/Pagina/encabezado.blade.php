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
                  <img src="{{ url($fotoUser) }}"  alt="User Image"  style="width:20px;height:20px;">
                  <span class="hidden-xs"> {{ Auth::user()->usuario }} <span class="caret"></span>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">

                      <img src="{{url($fotoUser)}}"  alt="User Image"  style="width:50px;height:50px;">               
                    <p>
                     <legend><b>{{Auth::user()->rol}}</b></legend>
                      <small> <?php echo date("d-M-Y"); ?></small>
                    </p>
                  </li>
            
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/editar_perfil_docente" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
  <a href="{{ url('/logout') }}"  class="btn btn-default btn-flat"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Salir </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>                                   
                    </div>

                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
