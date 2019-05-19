@extends('principal')
@section('title','Editar Rol Usuario')
@section('content')

<section class="container-fluid spark-screen">
<div class="row" >

<div class="col-md-12">

  <div class="box box-primary box-gris">
    <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Asignar rol</strong></h3>
    </div><!-- /.box-header -->
   
    <div id="zona_etiquetas_roles" style="background-color:white;" >
    Roles asignados:
    @foreach($usuario->getRoles() as $rl)
      <span class="label label-success" style="margin-left:10px;">{{ $rl }} </span> 
    @endforeach
    
    
    </div>
    <div class="box-body">

          <div class="col-md-12">
            <div class="form-group">
            <label class="col-sm-2" for="tipo">Rol a asignar*</label>
                <div class="col-sm-6" >         
                  <select id="rol1" name="rol1" class="form-control">

                           @foreach($roles as $rol)
                           <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                           @endforeach
                  </select>    
                </div>

                <div class="col-sm-4" >

                  <button type="button" class="btn btn-xs btn-primary" onclick="asignar_rol({{ $usuario->id }});" >Asignar rol</button>    
                </div>


            </div>

          </div>
          <hr>

           <div class="col-md-12">
            <div class="form-group">
            <label class="col-sm-2" for="tipo">Rol a quitar*</label>
                <div class="col-sm-6" >         
                  <select id="rol2" name="rol2" class="form-control">
                           @foreach($roles as $rol)
                           <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                           @endforeach
                  </select>    
                </div>

                <div class="col-sm-4" >         
                  <button type="button" class="btn btn-xs btn-warning" onclick="quitar_rol({{ $usuario->id }});" >Quitar rol</button>    
                </div>


            </div>

          </div>
    </div>

  </div> <!--box -->


  <div class="box box-success box-gris" >
 
      <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Información Usuario</strong></h3>
      </div><!-- /.box-header -->
     


      <div class="box-body">
              <div class="row">
               <div class="col-md-2"></div> 
                <div class="col-md-8 text-center" id="rsCarreraDirector" >


                </div>
                <div class="col-md-2"></div>
              </div>
           
        

          <form   action="asignar_director_carrera"  method="post" id="f_asignar_director_carrera"  class="form_entrada"  >
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                <input type="hidden" name="idUsu" value="{{ $usuario->id }}"> 
          <div class="col-md-6">
              <div class="form-group">
                    <label class="col-sm-3" for="nombre">Nombres:</label>
                    <div class="col-sm-9" >
                      <input type="text"  readonly="" class="form-control" id="nombres" name="nombres"  value="{{ $usuario->nombre }}"  required   >
                       </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->
                
          <div class="col-md-6">
              <div class="form-group">
                    <label class="col-sm-3" for="apellido">Apellidos:</label>
                    <div class="col-sm-9" >
                    <input type="text" class="form-control" readonly="" id="apellidos" name="apellidos" "  value="{{ $usuario->apellido }}" required >
                    </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->

<br><br>

 <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-3" for="celular">Teléfono</label>
                       
                       <div class="col-sm-9" >
                        <input type="text"  readonly="" class="form-control" id="telefono" name="telefono"  value="{{ $usuario->telefono }}" required >
                       </div>

                      </div><!-- /.form-group -->
          </div><!-- /.col -->



   <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-3" for="celular">Celular:</label>
                       
                       <div class="col-sm-9" >
                        <input type="text" readonly="" class="form-control" id="celular" name="celular"  value="{{ $usuario->celular  }}" required >
                       </div>

                      </div><!-- /.form-group -->
          </div><!-- /.col -->
<!--Slug para verificar is es director de carrera para asignarle a una carrera-->
@foreach($usuario-> getRoles() as $roles)
@if($roles=="director")


   

       <br><br>  
<div class="col-md-6">  
<div class="form-group">
  <label class="col-sm-3" for="carrera">Director de:</label>
<div class="col-md-9">
   @if(count($carrera))
   <select class="form-control" name="carrera" id="carrera" required="">
 <option value="">Seleccione carrera</option>
  @foreach($carrera as $car)
    <option value="{!! $car->id !!}">{{ $car->nombre }}</option>
  @endforeach

    </select>
@else
<select class="form-control" required="">
  <option value="">No existen carreras registradas</option>
</select>

@endif
</div>

</div>
</div>


<br><br>
<div class="col-md-12 text-center">  
<button class="btn-info"> Actualizar Director Carrera </button>
</div>















@endif
@endforeach



          </form>                  
      </div>
                    
    </div> <!--Cierre box gris-->

  <div class="box box-info   box-gris" style="margin-bottom: 200px;">
    <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Acceso al sistema</strong></h3>
    </div><!-- /.box-header -->
    <div id="notificacion_E3" ></div>
    <div class="box-body">


                  <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
                    <h3 class="box-title">Datos de acceso</h3>
                  </div>
       

                <form   action="{{ url('editar_acceso') }}"  method="post" id="f_editar_acceso"  class="form_entrada"  >
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                <input type="hidden" name="idUsu" value="{{ $usuario->id }}"> 


<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 text-center">
    <div id="notificacion_editar_acceso"></div>


  </div>
  <div class="col-md-3"></div>

</div>




                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="email">Cédula*</label>
                    <div class="col-sm-10" >
                    <input type="text" readonly="" class="form-control" id="cedula" name="cedula"  value="{{ $usuario->cedula  }}"  required >
                    </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="email">Nueva Contraseña*</label>
                    <div class="col-sm-10" >
                    <input type="password" class="form-control" id="password" name="password"  >
                    </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                    <div class=" col-xs-12 box-gris text-center ">
                                        <button type="submit" class="btn btn-primary">Actualizar Acceso</button>
                    </div>
                   </form>

         </div>

  </div>
  </div>                     
</div>








<body onload="cargarCombox2()"></body>

    <script>
        //Cargra datos conbox
   function cargarCombox2(){
   
  $('#carrera option:eq({{$usuario->carrera}})').prop('selected', true);
 


  }
    </script>




</section>




@endsection