    <aside class="main-sidebar">

 <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel text-center">

              <img src="{{  url($fotoUser)}}" class="img-circle"  alt="User Image"  style=" width:130px;  height:150px;">

          </div>

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

     <li class="header">MENÚ</li>

               <li class="treeview">
              <a href="{{ url('/home') }}">
                <i class="fa fa-home"></i> <span>INICIO</span>
              </a>

            </li>

              <li class="treeview">
              <a href="#">
                <i class="fa  fa-users"></i> <span>Perfil</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li class="active"><a href="{!!url('/editar_perfil_docente')!!}" ><i class="fa fa-circle-o"></i>Datos informativos </a></li>

                <li class="active"><a href="{{ url('/estudios_docente')}}"  ><i class="fa fa-circle-o"></i>Estudios</a></li>
              </ul>
            </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-fw fa-envelope"></i> <span>PORTAFOLIO</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{url('consultar_portafolio')}}" ><i class="fa fa-circle-o"></i>Crear</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-fw fa-user"></i> <span>DECANO</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{ url('/gestion_parametro') }}" ><i class="fa fa-circle-o"></i>Parametro. </a></li>
              </ul>
               <ul class="treeview-menu">
                <li class="active"><a href="{{ url('gestion_periodo') }}" ><i class="fa fa-circle-o"></i>Periodo. </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-fw fa-database"></i> <span>REPORTES</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{ url('reportes') }}" onclick="get(3);" ><i class="fa fa-circle-o"></i> Reportes </a></li>
                <li class="active"><a href="javascript:void(0);" onclick="" ><i class="fa fa-circle-o"></i> Graficas </a></li>
              </ul>
            </li>



              </ul>
        </section>
        <!-- /.sidebar -->

           </aside>