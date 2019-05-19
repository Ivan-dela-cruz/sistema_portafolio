@extends('principal')
@section('title','Inicio')
@section('content')


 <section class="container-fluid spark-screen" >
 

<div class="row"> 
  <div class="col-md-6 text-center" >
     <h3><span class="">Perfil Usuario</span></h3>
     <a href="{!!url('editar_perfil_docente')!!}" ><img src="{{ url('imagenes/logoperfil.png')}}" style="height:30%; width: 30%;" > </a>
   </div>


@role('docente')
@include('Rol/docente')
@endrole
@role('director')
@include('Rol/coordinador')
@endrole
@role('vicedecano')
@include('Rol/decano')
@endrole
</div>

</section>



@endsection
