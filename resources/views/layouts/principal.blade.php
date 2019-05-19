<!DOCTYPE html>
<html>
<head>
    <title>@yield('title','Default')| Panel Administracio</title>

    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css') }}">

    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/metodo.js')}}"></script>

    <!-- para los mensajes de exito o rechazo -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}">

    @yield('styles')

</head>
<body>

<div class="container">

    <section> @include('ComponentePagina.header') </section>

    <section> @yield('content')</section>

    <section> @include('ComponentePagina.footer')</section>

</div>


<!-- Metodo del  funcion subirPdf -->


@yield('scripts')

</body>
</html>