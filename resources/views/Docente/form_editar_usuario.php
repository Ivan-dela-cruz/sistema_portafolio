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
            <form id="frm_editar_docente" method="post" action="editar_docente" class="form-horizontal form_entrada">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="idDocente" value="<?= $usuario->id; ?>">


                <div class="box-body ">
                    <div class="form-group col-xs-12">
                        <label for="nombre">Nombres*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               value="<?= $usuario->nombre; ?>" readonly>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="apellido">Apellidos*</label>
                        <input type="text" class="form-control" id="apellido" name="apellido"
                               value="<?= $usuario->apellido; ?>" readonly>
                    </div>


                    <div class="form-group col-xs-12">
                        <label for="cedula">Cedula*</label>
                        <input type="text" name="cedula" class="form-control" id="cedula" readonly
                               value="<?= $usuario->cedula ?>">
                    </div>


                    <div class="form-group col-xs-12">
                        <label for="celular">Celular*</label>
                        <input type="text" class="form-control" id="celular" value="<?= $usuario->celular; ?>"
                               name="celular">
                    </div>


                    <div class="form-group col-xs-12">

                        <label for="telefono">Teléfono*</label>
                        <input type="text" class="form-control" name="telefono" id="telefono"
                               value="<?= $usuario->telefono; ?>">

                    </div>


                    <div class="form-grup col-xs-6">
                        <label>Dirección*</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required=""
                               value="<?= $usuario->direccion ?>">
                    </div>

                    <div class="form-grup col-xs-6">

                        <label>Fecha Nacimiento*</label>
                        <input type="date" class="form-control" id="fecha" name="fecha"
                               value="<?= $usuario->fecha_nacimiento ?>" required="">
                    </div>


                    <div class="form-group col-xs-12">
                        <label for="sexo">Sexo </label>

                        <select id="sexo" name="sexo" class="form-control" required="">
                            <option value="0">-- SELECCIONE SEXO --</option>
                            <option value="1 ">FEMENINO</option>
                            <option value="2 ">MASCULINO</option>
                        </select>
                    </div>


                    <div class="form-group col-xs-12">

                        <label for="nacionalidad"> Nacionalidad:*</label>
                        <select id="nacionalidad" class="form-control" name="nacionalidad" required="">
                            <option value="0"> --SELECCIONE NACIONALIDAD --</option>
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


                    <div class="form-group col-xs-12">
                        <label for="estado"> Estado Civil:*</label>
                        <select id="estado" name="estado" class="form-control" required="">
                            <option value="0">-- SELECCIONE ESTADO CIVIL --</option>
                            <option value="1">CASADO(A)</option>
                            <option value="2">DIVORCIADO(A)</option>
                            <option value="3">SEPARADO(A)</option>
                            <option value="4">SOLTERO(A)</option>
                            <option value="5">UNION LIBRE</option>
                            <option value="6">VIUDO(A)</option>
                        </select>

                    </div>


                    <div class="form-group col-xs-12">
                        <label for="identidad">Identidad:*</label>
                        <select id="identidad" name="identidad" class="form-control" required="">
                            <option value="0">-- SELECCIONE IDENTIDAD --</option>
                            <option value="1">INDIGENA</option>
                            <option value="2">AFROECUATORIANO/A</option>
                            <option value="3">MONTUBIO/A</option>
                            <option value="4">MESTIZO/A</option>
                            <option value="5">BLANCO/A</option>
                        </select>

                    </div>


                    <div class="form-group col-xs-12">

                        <label for="email">Correo electrónico:*</label>

                        <input type="text" class="form-control" id="email" name="email" readonly
                               value="<?= $usuario->email; ?>">

                    </div>


                </div>


                <div class="box-footer">
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

            <form id="frm_subir_imagen" name="frm_subir_imagen" method="post" action="subir_imagen" class="formarchivo"
                  enctype="multipart/form-data">
                <input type="text" name="id_usuario_foto" value="<?= $usuario->id; ?>">

                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">

                <div class="box-body">

                    <div class="form-group col-xs-12">


                        <?php if (!$usuario->foto) {
                            $fotoUser = "imagenes/avatar.png";

                        } else {
                            $fotoUser = $usuario->foto;
                        }

                        ?>

                        <img src="<?= url($fotoUser) ?>" alt="User Image" style="width:160px;height:160px;"
                             id="fotografia_usuario" name="fotografia_usuario">
                        <!-- User image -->
                    </div>


                    <div class="form-group col-xs-12">
                        <label>Agregar Imagen </label>
                        <input name="archivo" id="archivo" type="file" class="archivo form-control" required/><br/><br/>
                    </div>


                    <div class="box-footer">

                        <button type="submit" class="btn btn-primary">Actualizar Imagen</button>
                    </div>


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
            <form method="post" id="frm_cambiar_clave" class="form_entrada" action="cambiar_clave">
                <input type="hidden" name="idUsu" value="<?= $usuario->id; ?>">
                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico </label>
                        <input type="email" class="form-control" id="email_usuario" name="email"
                               placeholder="Entrar email" readonly value="<?= $usuario->email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"></label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Password">
                    </div>


                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cambiar Datos</button>
                </div>
            </form>
        </div>

    </div>    <!-- end col mod 6 -->

</div> <!-- end row -->


<script>

    //Cargra datos conbox
    function cargarCombox() {
        $('#sexo option:eq(<?=$usuario->sexo;?>)').prop('selected', true);
        $('#nacionalidad option:eq(<?=$usuario->nacionalidad;?>)').prop('selected', true);
        $('#estado option:eq(<?=$usuario->estado_civil;?> )').prop('selected', true);
        $('#identidad option:eq(<?=$usuario->identidad;?>)').prop('selected', true);
    }

    cargarCombox();

</script>