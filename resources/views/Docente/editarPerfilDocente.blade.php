@extends('principal')
@section('title','Perfil Docente')
@section('content')
<section class="content" id="contenido_principal">
	
  <div class="row">  

    <div class="col-md-6">

          <div class="box box-primary">
                          
                          <div class="box-header">
                          <h3 class="box-title">Editar información Docente</h3>
                          </div><!-- /.box-header -->

          <div id="notificacion">
            

          </div>



  <!-- action  editor se pued utilizar directamente  pero se recarga toda la  pagina  podemos borrar el action igual funciona -->
  <!-- En este caso utilizamos ajax con la clase Form_entrada para no recargar toda la pg -->
          <form  id="frm_editar_docente"  method="post"  action="editar_docente" class="form-horizontal form_entrada" >                
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <input type="hidden" name="idDocente" value="{{$usuario->id}}">              



  <div class="box-body ">
  <div class="form-group col-xs-12">
  <div class="form-group col-xs-6">
                                <label for="nombre">Nombres*</label>
                                <input type="text" class="form-control" required="" id="nombre" name="nombre"  value="{!! $usuario->nombre !!}"  >
    <label style="color:#8D8A8A; font-size:12px" >Nombres completos </label>

  </div>

     
  <div class="form-group col-xs-2 text-center">
  <br><br>
  <b>    </b>
  </div>

          <div class="form-group col-xs-6">
                      <label for="apellido">Apellidos*</label>
                    <input type="text" class="form-control" id="apellido" required="" name="apellido" value="{!! $usuario->apellido !!}"  >
    <label style="color:#8D8A8A; font-size:12px" >Apellidos Completos </label>
          </div>
  </div>

  <div class="form-group col-xs-12">
  <label for="cedula">Cedula*</label>
  <input type="text" name="cedula" class="form-control" id="cedula" readonly  value="{{ $usuario->cedula }}"  >
  </div>



        <div class="form-group col-xs-12">
          <div class="form-group col-xs-6">
              <label for="celular">Número de Celular:*</label>
              <input  type="text"  class="form-control" id="celular" pattern="[0-9]{10}"  title="Ingrese 10 Dígitos" value="{{ $usuario->celular }}"  required=""  name="celular" >

              <label style="color:#8D8A8A; font-size:12px" >Ejemplo. (0992266335) 10 dígitos </label>
          </div>

  <div class="form-group col-xs-2 text-center">
  <br><br>
  <b>  ,  </b>
  </div>

  <div class="form-group col-xs-6" >

  <label for="telefono">Número de Teléfono:  
  *</label>
  <input type="tel" autocomplete="false"  pattern="[0-9]{9}" title="Ingrese 9 Dígitos"  required="" class="form-control" name="telefono" id="telefono" value="{!! $usuario->telefono !!}">
  <label style="color:#8D8A8A; font-size:12px" >Ejemplo. (03)2266335  9 dígitos</label>
  </div>

  </div>



  <div class="form-group col-xs-12">
  <div class="form-group col-xs-6">
  <label>Lugar*</label>
  <input type="text" class="form-control" id="lugar" name="lugar" required=""  value="{{$usuario->lugarNacimiento}}"> 
  <label style="color:#8D8A8A; font-size:12px" >Ejemplo Ciudad. </label>
  </div>
    
  <div class="form-group col-xs-2 text-center">
  <br><br>
  <b>  ,  </b>
  </div>
    

  <div class="form-group col-xs-6">
  <label>Fecha de Nacimiento* </label>
  <input type="date" class="form-control"  id="fecha" name="fecha" value="{{ $usuario->fechaNacimiento}}" required="">

  <label style="color:#8D8A8A;font-size: 12px "> Seleccione Fecha. </label>
  </div>

  </div>


  <div class="form-group col-xs-12">
    <label>Dirección Domiciliaria*</label>
  <textarea  type="text" name="direccionDomi" class="form-control"  id="direccionDomi"  required="">{{$usuario->direccion}}</textarea>

  <label style="color:#8D8A8A;font-size: 12px ">Barrio, Calle Principal, Calle Secundaria, Número de Casa, donde vive actualmente</label>
  </div>




  <div class="form-group col-xs-12">
  <label for="cargasFamiliar">Número de cargas Familiares:*</label>
  <select id="cargasFamiliar" name="cargasFamiliar"  class="form-control" required=""> 
  <option value=""> --SELECCIONE CARGAS FAMILIARES --</option>
  <option value="1">0</option>
  <option value="2">1</option>
  <option value="3">2</option>
  <option value="4">3</option>
  <option value="5">4</option>
  <option value="6">5</option>
  <option value="7">6</option>
  <option value="8">7</option>
  <option value="9">8</option>
  <option value="10">9</option>
  <option value="11">10</option>
  <option value="12">Mayor a 10</option>
  </select>   

  </div>





          <div class="form-group col-xs-12">
                                <label for="sexo">Género* </label>                  
                               
                                 <select id="sexo" name="sexo" class="form-control" required="">
          <option value="">-- SELECCIONE GÉNERO --</option>
          <option value="1 ">FEMENINO</option>
          <option value="2 ">MASCULINO</option>
                                </select>                    
          </div>



  <div class="form-group col-xs-12">

  <label for="nacionalidad"> Nacionalidad:*</label>
  <select id="nacionalidad" class="form-control" name="nacionalidad" required=""> 
  <option value=""> --SELECCIONE NACIONALIDAD --</option>
  <option value="1">ARGENTINA</option>
  <option value="2">BOLIVIANA</option>
  <option value="3">BRASILENA</option>
  <option value="4">CHILENA</option>
  <option value="5">COLOMBIANA</option>
  <option value="6">CUBANA</option>
  <option value="7">ECUATORIANA</option>
  <option value="8">MEXICANA</option>
  <option value="9">PARAGUAYA</option>
  <option value="10">PERUANA</option>
  <option value="11">URUGUAYA</option>
  <option value="12">VENEZOLANA</option>
  </select>



  </div>


  <div class="form-group col-xs-12" >
  <label for="estado"> Estado Civil:*</label>
  <select id="estado"   name="estado" class="form-control"  required=""> 
  <option value="" >-- SELECCIONE ESTADO CIVIL --</option>
  <option value="1">CASADO(A)</option>
  <option value="2">DIVORCIADO(A) </option>
  <option value="3">SEPARADO(A)</option>
  <option value="4">SOLTERO(A)</option>
  <option value="5">UNION LIBRE</option>
  <option value="6">VIUDO(A)</option>
  </select>

  </div>



    


          </div>



          <div class="box-footer text-center">
               <button type="submit" class="btn btn-primary">Actualizar Datos</button>
          </div>
          </form>
          </div>

    </div> <!-- end col mod 6 -->

    <div class="col-md-6">


        <div class="box box-primary">
                        <div class="box-header">
                          <h3 class="box-title">Cambiar Fotografia</h3>
                        </div><!-- /.box-header -->
       
        <div id="notificacionImagen">
          
        </div>

        <form  id="frm_subir_imagen" name="frm_subir_imagen" method="post" action="subir_imagen" class="formarchivo text-center" enctype="multipart/form-data" >                
         <input type="hidden" name="id_usuario_foto" value="{!!$usuario->id!!}">

         <input type="hidden" name="_token" id="_token"  value="{{ csrf_token()}}"> 

        <div class="box-body">

          <div class="form-group col-xs-12" >


    @if(!$usuario->foto)
    @php $fotoUser="imagenes/avatar.png"; @endphp
    @else
    @php $fotoUser=$usuario->foto; @endphp
    @endif

            <img src="{{ url($fotoUser) }}"  alt="User Image"   style="width:160px;height:160px;" id="fotografia_usuario" name="fotografia_usuario" >
                  <!-- User image -->
         </div>


        <div class="form-group col-xs-12"  >
               <label>Agregar Imagen </label>
                <input name="archivo" id="archivo" type="file"  accept="image/*"  class="archivo form-control"  required/><br />
        </div>





       
        <div class="box-footer text-center">
                        
                            <button type="submit" class="btn btn-primary">Actualizar Imagen</button>
        </div>

         


        </div>

        </form>

        </div>

    </div>    <!-- end col mod 6 -->

      <div class="col-md-6">

  <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Historial Personal</h3>
                  </div><!-- /.box-header -->
                  <div id="notificacion_cambiarHistorial"></div>
                  <!-- form start -->
                  <form method="post" id="frm_cambiar_historial" class="form_entrada" action="cambiar_historial" >
                       <input type="hidden" name="idDoc" value="{{ $usuario->id}}"> 
                     <input type="hidden" name="_token" id="_token"  value="{{ csrf_token() }}"> 
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Facultad Académica en la que labora.. </label>
  <select id="facultad"   name="facultad" class="form-control"  required=""> 
  <option value="">-- SELECCIONE FACULTAD --</option>
  <option value="1">Ciencias de la Ingeniería y Aplicadas</option>
  </select>

                      </div>
                      <div class="form-group">
                        <label for="exampleIngresoUtc">Fecha ingreso a la UTC:</label>
                        <input type="month" class="form-control" id="ingresoUtc" required=""  value="{!! $usuario->fechaIngresoUtc !!}" name="ingresoUtc" >
                      </div>
                    
                      
                    </div><!-- /.box-body -->

                    <div class="box-footer text-center">
                      <button type="submit" class="btn btn-primary">Cambiar Datos</button>
                    </div>
                  </form>
                </div>

    </div>    <!-- end col mod 6 -->





















      <div class="col-md-6">

  <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Cambiar Password</h3>
                  </div><!-- /.box-header -->
                  <div id="notificacion_cambiarClave"></div>
                  <!-- form start -->
                  <form method="post" id="frm_cambiar_clave" class="form_entrada" action="cambiar_clave" >
                       <input type="hidden" name="idUsu" value="{{$usuario->id}}"> 
                     <input type="hidden" name="_token" id="_token"  value="{{ csrf_token()}}"> 
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico </label>
                        <input type="email" class="form-control" id="email_usuario" name="email" placeholder="Entrar email"  readonly  value="{{ $usuario->email}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1"></label>
                        <input type="password" required="" class="form-control" id="clave" name="clave" placeholder="Password">
                      </div>
                    
                      
                    </div><!-- /.box-body -->
   
                    <div class="box-footer text-center">
                      <button type="submit" class="btn btn-primary">Cambiar Datos</button>
                    </div>
                  </form>
                </div>

    </div>    <!-- end col mod 6 -->










  </div> <!-- end row -->


  <script>

  //Cargra datos conbox
   function cargarCombox(){
  $('#sexo option:eq({{ $usuario->sexo}})').prop('selected', true);    
  $('#nacionalidad option:eq({{ $usuario->nacionalidad }})').prop('selected',true);
  $('#estado option:eq({{ $usuario->estadoCivil }} )').prop('selected',true);
  $('#cargasFamiliar option:eq({{$usuario->cargaFamiliar}})').prop('selected',true);
  $('#facultad option:eq({!! $usuario->facultad !!})').prop('selected',true);
  }



  setTimeout('cargarCombox()',300);



  </script>

</section>
@endsection