<!DOCTYPE html>
<html>
@section('htmlheader')
    <title>
        @yield('title','Default')| Portafolio Docente
    </title>
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href='imagenes/iconoutc.ico' rel='icon' type='image/x-icon'/>
    <!-- Para los mensales de  bien y mal-->
    <link href="{{ asset('css/mensajes.css')}}" rel="stylesheet">
    <!-- Ionicons -->
    <link href="{{ asset('css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/iCheck/flat/blue.css') }}" rel="stylesheet">
    <!-- Morris chart -->

    <link href="{{asset('plugins/morris/morris.css') }}" rel="stylesheet"/>

    <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">

    <!-- No borrar sirven para las alertas de titulos-->
    <link href="{{asset('sweetAlert/sweetalert.css')}}" rel="stylesheet" type="text/css">




@show
<body class="skin-blue sidebar-mini">
<!--skin-blue sidebar-mini-->
<div class="wrapper">
@if(Auth::user()->fotos)
    @php
        $fotoUser=Auth::user()->fotos;
    @endphp
@else
    @php $fotoUser="imagenes/avatar.png";  @endphp
@endif

@include('Pagina/encabezado')

@include('Pagina/menu')
<!-- Main Header -->
    <div class="content-wrapper">
        <!-- aqui va el submenu-->

        <section class="content">
            <h4><a href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i>Atras</a></h4>
            @yield('content')
        </section>
    </div>
</div>
<!-- El icono de espera ......-->
<div align="center" id="cargando" style="display: none;">
    <br>
    <label style="color:#FFF; background-color:#ABB6BA; text-align:center">
        Espere...
    </label>
    <img align="middle" alt="cargador" src="{{ url('imagenes/cargando.gif') }}">
    <label style="color:#ABB6BA">
        Realizando tarea solicitada ...
    </label>
    <br>
    <hr style="color:#003" width="50%">
    <br>
    </br>
    </hr>
    </br>
    </img>
    </br>
</div>
@section('scripts')


    <script src=" {{asset('plugins/jQuery/jQuery-2.1.4.min.js') }} ">
    </script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js">
    </script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js') }}">
    </script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js">
    </script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }} ">
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js')}} ">
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}  ">
    </script>
    <!-- javascript del sistema laravel -->
    <script src=" {{asset('js/metodo.js')}} ">
    </script>
    <script src="{{ url('js/metodosPortafolio.js')}}" type="text/javascript">
    </script>
    <!-- Librerias de graficas-->

    <!-- No boorar sirven para las alertas de titulos-->
    <script src="{{asset('sweetAlert/sweetalert.js')}}" type="text/javascript">
    </script>
    @yield('javascript')
@show
</body>

</html>