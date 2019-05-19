@extends('principal')

@section('title','Listado Docentes ')

@section('content')

<section class="content"  id="contenido_principal">

<div class="box box-primary">

<div class="box-header"> 
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center">

      <legend><b>PORTAFOLIOS ACADÉMICOS DOCENTES REGISTRADOS</b></legend>

    </div>
    <div class="col-md-1"></div>

  </div>
</div>

<div class="box-body">

  <div class="row">

    <div class="col-md-1"> </div>

    <div class="col-md-3">
      @if(count($periodos))
      <select class="form-control" name="periodo" id="periodo" onchange="idCarreraAndTexto()">

        @foreach($periodos as $per)
        <option value="{{ $per->id}}">{{ $per->desde}}-{{ $per->hasta}}</option>
        @endforeach

      </select>
      @else
      <b> <legend style="color:red;"> No existe Períodos registrados</legend> </b>

      @endif


    </div>

    <div class="col-md-4">
      <div class="form-group">
        @if(count($carrera))
        <select  class="form-control" name="carrera" id="carrera" onchange="idCarreraAndTexto()">
          @foreach($carrera as $car)
          <option value="{!! $car->id !!}">{{ $car->nombre}}</option>
          @endforeach
        </select>
        @else
        <b> <legend style="color:red;"> No existen Carreras Registradas</legend> </b>
        @endif

      </div>

    </div>
    <div class="col-md-3">
      <div class="input-group">

        <input type="text" name="texto" id="texto" onkeyup="idCarreraAndTexto()" class="form-control" placeholder="Cédula, Nombres,  Apellidos">

        <span class="input-group-btn">

          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </div>
    <div class="col-md-1"></div>

  </div>

</div><!--Cierre box body-->

<div class="box-footer">
  
</div>

</div>

  <script >

    function idCarreraAndTexto(){
      var url="";

      var codCarrera=document.getElementById("carrera").value;
      var texto=document.getElementById("texto").value;
      var codPer=document.getElementById("periodo").value;

//alert(codCarrera+texto);
if (texto=="") {
  url="buscar_listado_docente/"+codPer+"/"+codCarrera;
}else{
  url="buscar_listado_docente/"+codPer+"/"+codCarrera+"/"+texto+"";
}
$("#mostrarDocentes").html($("#cargando").html());
$.get(url,function(rs){
  $("#mostrarDocentes").html(rs);
})

  //Para la Paginacion
  $(document).on("click",".pagination li a" ,function(e){
//Para q no se vaya a la otra vista al hacer click no salga de la pagina
e.preventDefault();
var url =$(this).attr("href");
$("#mostrarDocentes").html($("#cargando").html());
$.get(url, function(result){
  $("#mostrarDocentes").html(result);
});
});


}


//setTimeout( "idCarreraAndTexto()",800);

</script>


<div class="row" id="mostrarDocentes">



</div>

</section>

<body onload="idCarreraAndTexto()"></body>
@endsection


