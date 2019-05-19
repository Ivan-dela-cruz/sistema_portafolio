    <aside class="main-sidebar">

 <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel text-center">

              <img src="{{  url($fotoUser)}}" class="img-circle"  alt="User Image"  style=" width:130px;  height:150px;">

          </div>

          <!-- /.search form -->


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


@role('docente')
@include('Rol.menuDocente')
@endrole

@role('director')
@include('Rol.menuCoordinador')
@endrole

@role('vicedecano')
@include('Rol.menuDecano')
@endrole

</ul>



        </section>
        <!-- /.sidebar -->

           </aside>