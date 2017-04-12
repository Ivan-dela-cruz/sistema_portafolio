<!DOCTYPE html>
<html>
<head>
<title>@yield('title','Default')| Portafolio Docente</title>




@yield('css')
    
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->

      <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <!-- Ionicons -->

    <link rel="stylesheet" href="{{ asset('css/pe-icon-7-stroke.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
      
    <!-- bootstrap wysihtml5 - text editor  para el envio del email-->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
 

     <link rel="stylesheet" href="{{ asset('css/sistemalaravel.css') }}">

</head>
 <body class="hold-transition skin-purple sidebar-mini">



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
        <div class="content-wrapper" style="min-height:500px;">
     @include('Pagina.subMenu')

 
   
      @yield('content')

    </div>



</div>


<!-- El icono de espera ......-->

  <div style="display: none;" id="cargando" align="center">
            <br>
         <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

         <img src="{{ url('imagenes/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

          <br>
         <hr style="color:#003" width="50%">
         <br>
       </div>


@yield('javascript')
    <script src=" {{asset('plugins/jQuery/jQuery-2.1.4.min.js') }} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js') }}"></script>
 
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{asset('plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js') }} "></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }} "></script>
    <!-- jQuery Knob Chart -->
    
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }} "></script>
    <!-- datepicker -->
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }} "></script>
    <!-- Slimscroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }} "></script>
    <script src=" {{ asset('plugins/fastclick/fastclick.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }} "></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js')}} "></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}  "></script>
 <!-- javascript del sistema laravel -->
    <script src=" {{asset('js/metodo.js')}} "></script>
    <script type="text/javascript" src="{{ url('js/metodosPortafolio.js')}}"></script>
   <!-- Librerias de graficas-->

</body>
</html>


