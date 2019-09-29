function irarriba() {
    $('html, body').animate({
        scrollTop: 0
    }, 300);
}

function getpdf() {
    var url = "lista_reportes";
    //alert(url);
    actualizarPagina(url);
}

//Verificar estudios y titulos obtenidos
function estudiosRealizados() {
    var url = "actualizar_estudios_docente";
    $("#ventanaModificarEstudioDoc").html($("#cargando").html());
    $.get(url, function (rs) {
        $("#ventanaModificarEstudioDoc").html(rs);
    });
}

//function get(listado) {
//funcion para cargar los diferentes  en general
//  if (listado == 3) {
//    var url = "reportes";
//}
//var idDoc = $("#docente").val();
//var idTip = $("#tipo").val();
//var url2 = url + "/" + idDoc + "/" + idTip;
//$("#contenido_principal").html($("#cargando").html());
//$.get(url, function(resul) {
//  $("#contenido_principal").html(resul);
//})
//}
//Verificar estudios y titulos obtenidos
function actualizarPagina(vUrl) {
    //Id Del Docente logueado
    var idDoc = $("#docente").val();
    var url = vUrl + "/" + idDoc;
    //alert (url);
    $("#contenido_principal").html($("#cargando").html());
    $.get(url, function (result) {
        $("#contenido_principal").html(result);
    });
}

//Buscar portafolios Academico docentes
function buscarPortafolio() {
    var periodo = $("#periodoBuscar").val();
    // alert("hola"+periodo);
    var url = "buscar_portafolio_docente/" + periodo + "";
    $("#rsPortafolio").html($("#cargando").html());
    $.get(url, function (resul) {
        $("#rsPortafolio").html(resul);
    })
}

//Elimina el titulo del docente logeado
function borrarTitulo(idTit) {
    swal({
        title: "Esta Seguro?",
        text: "Desea eliminar Título.!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var url = "borrar_titulo/" + idTit;
            var nota = "notaBorrar";
            $("#" + nota + "").html($("#cargando").html());
            $.get(url, function (result) {
                $("#" + nota + "").html(result);
                //Se carga la pagina en un tiempo
                //setTimeout( "estudiosRealizados()",1000);
                estudiosRealizados();
            });
            swal("Eliminado!", "Titulo se ha eliminado correctamente.", "success");
        } else {
            swal("Cancelado!", "Desea cancelar la acción:)", "error");
        }
    });
}

function editPeriodo(idPer, inicioPer, finPer) {
    var url = "actualizar_periodo/" + idPer;
    document.getElementById("idPeriodo").value = idPer;
    document.getElementById("fechaInicio2").value = inicioPer;
    document.getElementById("fechaFin2").value = finPer;
}

function editParametro(idParametro, nombre) {
    var url = "actualizar_parametros/" + nombre;
    document.getElementById("idParametro").value = idParametro;
    document.getElementById("nombreParametro").value = nombre;
    //$("#nombreParametro").val(nombre); // leccion10
}

function borrarParametro(idPar) {
    // alert("dentro metodo");
    swal({
        title: "Esta Seguro?",
        text: "Desea eliminar Parámetro.!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var url = "borrar_parametro/" + idPar;
            var nota = "rsListaParametro";
            $("#" + nota + "").html($("#cargando").html());
            $.get(url, function (result) {
                $("#" + nota + "").html(result);
                //Se carga la pagina en un tiempo
                //setTimeout( "estudiosRealizados()",1000);
                parametrosCreados();
            });
            swal("Eliminado!", "Parámetro se ha eliminado correctamente.", "success");
        } else {
            swal("Cancelado!", "Desea cancelar la operacion", "error");
        }
    });
}

function mostrarseccion(num) {
    var id_usuario = $("#usuario_seleccionado").val();
    //$("#seccion_seleccionada").val(num);//Este parece que no hace nada
    if (num == 1) {
        var url = "form_editar_usuario/" + id_usuario + "";
    }
    if (num == 2) {
        var url = "form_educacion_usuario/" + id_usuario + "";
    }
    if (num == 3) {
        var url = "form_publicaciones_usuario/" + id_usuario + "";
    } //leccion 11
    $("#contenido_capa_edicion").html($("#cargando").html());
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul);
    })
}

//Actulizar perfil docente
$(document).on("submit", ".form_entrada", function (e) {
    //funcion para atrapar los formularios y enviar los datos
    e.preventDefault();
    //$('html, body').animate({
    //  scrollTop: '0px'
    //}, 200);
    var formu = $(this);
    var quien = $(this).attr("id");
    var id = $(this).attr("id");
    //Para limpiar el formulario dependiemdo del formulario
    var res = false;
    var cual = 0;
    //No estoy utilizando
    if (quien == "frm_cambiar_clave") {
        var varurl = "cambiar_clave";
        var divresul = "notificacion_cambiarClave";
    }
    if (quien == "f_editar_acceso") {
        var varurl = "../editar_acceso";
        var divresul = "notificacion_editar_acceso";
    }
    if (quien == "frm_agregar_titulo") {
        var varurl = "/agregar_titulo";
        var divresul = "notaEstudio";
        res = true;
        cual = 1;
    }
    if (quien == "frm_cambiar_historial") {
        var varurl = "cambiar_historial";
        var divresul = "notificacion_cambiarHistorial";
    }

    if (quien == "frm_crear_portafolio") {
        swal({
            title: "Esta Seguro?",
            text: "Desea crear el Portafolio Académico.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Si, Crear!",
            cancelButtonText: "No, Cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                var varurl = "crear_portafolio";
                var divresul = "notificacion_crear_portafolio";
                res = true;
                //    $("#" + divresul + "").html($("#cargando").html());
                $.ajax({
                    type: "POST",
                    url: varurl,
                    datatype: 'json',
                    data: formu.serialize(),
                    success: function (resul) {
                        $("#" + divresul + "").html(resul);
                        if (res) {
                            // $('#' + quien + '').trigger("reset");
                            buscarPortafolio();
                        }
                    }
                });
                swal("Creado!", "Portafolio Docente creado exitosamente.", "success");
            } else {
                swal("Cancelado!", "Desea cancelar la operacion", "error");
            }
        });
    }
    if (quien == "frm_agregar_materia_portafolio") {
        var varurl = "../agregar_materia_portafolio";
        var divresul = "notificacionAgregarMateria";
        cual = 10;
    }
    if (quien == "frm_crear_parametro") {
        var varurl = "crear_parametro";
        var divresul = "notificacion_crear_parametro";
        cual = 6;
    }
    if (quien == "frm_crear_periodo") {
        var varurl = "crear_periodo";
        var divresul = "notificacion_crear_parametro";
        cual = 2;
    }
    if (quien == "frm_periodo") {
        var varurl = "actualizar_periodo";
        var divresul = "notaPeriodo";
        cual = 3;
    }
    if (quien == "frm_parametro") {
        var varurl = "actualizar_parametro";
        var divresul = "notaParametro";
        cual = 4;
    }
    //Editar carrera director
    if (quien == "f_asignar_director_carrera") {
        alert("hola");
        var varurl = "../asignar_director_carrera";
        var divresul = "rsCarreraDirector";
    }
    $("#" + divresul + "").html($("#cargando").html());
    $.ajax({
        type: "POST",
        url: varurl,
        datatype: 'json',
        data: formu.serialize(),
        success: function (resul) {
            $("#" + divresul + "").html(resul);
            if (res) {
                $('#' + quien + '').trigger("reset");
            }
            if (cual == 1) {
                //Se carga la pagina  llamado al metodo estudiosRealizadas en un tiempo
                estudiosRealizados();
            }
            if (cual == 2) {
                periodosCreados();
            }
            if (cual == 3) {
                periodosCreados();
            }
            if (cual == 4) {
                parametrosCreados();
            }
            if (cual == 6) {
                parametrosCreados();
            }
            if (cual == 10) {
                materiasCreadas();
            }
        }
    });
});
//Para validar campos   perfil usuario
$(document).on("submit", ".form_entrada_validacion", function (e) {
    e.preventDefault();
    var quien = $(this).attr("id");
    var formu = $(this);
    var varurl = $(this).attr("action");
    var cual = 0;
    if (quien == "frm_editar_docente") {
        var varurl = "editar_docente";
        var divresul = "notificacion";
    }
    if (quien == "frm_agregar_titulo") {
        var varurl = "agregar_titulo";
        var divresul = "notaEstudio";
        cual = 1;
    }
    $("#" + divresul + "").html($("#cargando").html());
    // $("#div_notificacion_rol").html($("#cargando").html());
    $(".form-group").removeClass("has-error");
    $(".help-block").text('');
    $.ajax({
        // la URL para la petición
        url: varurl,
        data: formu.serialize(),
        type: 'POST',
        dataType: "html",
        success: function (resul) {
            $("#" + divresul + "").html(resul);
            irarriba();
            // $("#capa_formularios").html(resul);
            if (cual == 1) {
                //Para actualizar los estudios realizado
                estudiosRealizados();
            }
        },
        error: function (data) {
            var lb = "";
            var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, value) {
                $("#" + key + "_group").addClass("has-error");
                $("#" + key + "_span").text(value);
            });
            $("#" + divresul + "").html('');
        }
    });
})




//Subir imagen docente
//y
//Subir archivo
$(document).on("submit", ".formarchivo", function (e) {
    e.preventDefault();
    var formu = $(this);
    var nombreform = $(this).attr("id");
    var rs = false;
    //var seccion_sel=  $("#seccion_seleccionada").val();
    if (nombreform == "frm_subir_imagen") {
        var miurl = "subir_imagen";
        var divresul = "notificacionImagen";
        rs = "foto";
    }
    //Para subir archivos parametros
    if (nombreform == "frm_subir_archivoPdf") {
        var miurl = "../subir_archivoPdf";
        var divresul = "notaPdf";
        rs = "subir";
    }
    if (nombreform == "frm_subir_ParametroMat") {
        var miurl = "../subir_ParametroMat";
        var divresul = "notaSubirParametroMat";
        // alert("Aquie estoz");
        rs = "subir2";
    }
    if (nombreform == "frm_subir_ParametroPorta") {
        var miurl = "../subir_ParametroPorta";
        var divresul = "notaSubirParametroPorta";
        rs = "subir3";
    }
    if (nombreform == "frm_subir_actividad") {
        var miurl = "../subir_archivo_actividad";
        var divresul = "notaSubirActividad";
        rs = "subir4";
    }
    //Para obtener la informacion del archivo..
    //$("#"+divresul+"").html($("#cargando").html());
    var formData = new FormData($("#" + nombreform + "")[0]);
    $.ajax({
        url: miurl,
        type: 'POST',
        //pra pasar los datos del archivo
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        datatype: 'html',
        beforeSend: function () {
            $("#" + divresul + "").html($("#cargando").html());
        },
        success: function (rs2) {
            if (rs == "foto") {
                $("#fotografia_usuario").attr('src', $("#fotografia_usuario").attr('src') + '?' + Math.random());
                $("#" + divresul + "").html(rs2);
            }
            if (rs == "subir") {
                $("#" + divresul + "").html(rs2);
                //Actualizar el parametro de los productos cuando se guarda  un nuevo  archivo pdf
                actualizarParametro();
            }
            if (rs == "subir2") {
                $("#" + divresul + "").html(rs2);
                //Actualizar el parametro de los Asignatura cuando se guarda  un nuevo  archivo pdf
                actualizarParametro();
            }
            if (rs == "subir3") {
                $("#" + divresul + "").html(rs2);
                //Actualizar el parametro de los portafolio cuando se guarda  un nuevo  archivo pdf
                actualizarParametroPorta();
            }
            if (rs == "subir4") {
                $("#" + divresul + "").html(rs2);
                //Actualizar las actividades cuando se guarda  un nuevo  archivo pdf
                mostrarArchivo();
            }
        },
        error: function (xhr, status) {
            $("#" + divresul + "").html("<div class='alert alert-danger'><strong>Ha ocurrido un error!</strong> archivo demasiado Grande o Protegido.</div>");
        }
    });
    irarriba();
});

//Asignar rol
function asignar_rol(idusu) {
    var idrol = $("#rol1").val();
    //  var urlraiz = $("#url_raiz_proyecto").val();
    $("#zona_etiquetas_roles").html($("#cargando").html());
    var miurl = "../asignar_rol/" + idusu + "/" + idrol + "";
    $.ajax({
        url: miurl
    }).done(function (resul) {
        var etiquetas = "";
        var roles = $.parseJSON(resul);
        $.each(roles, function (index, value) {
            etiquetas += '<span class="label label-success">' + value + '</span> ';
        })
        $("#zona_etiquetas_roles").html(etiquetas);
    }).fail(function () {
        $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles o revise su conexion...</span>');
    });
}

//Quitar rol
function quitar_rol(idusu) {
    var idrol = $("#rol2").val();
    // var urlraiz = $("#url_raiz_proyecto").val();
    $("#zona_etiquetas_roles").html($("#cargando").html());
    var miurl = "../quitar_rol/" + idusu + "/" + idrol + "";
    $.ajax({
        url: miurl
    }).done(function (resul) {
        var etiquetas = "";
        var roles = $.parseJSON(resul);
        $.each(roles, function (index, value) {
            etiquetas += '<span class="label label-success" style="margin-left:10px;" >' + value + '</span> ';
        })
        $("#zona_etiquetas_roles").html(etiquetas);
    }).fail(function () {
        $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles  o revise su conexion...</span>');
    });
}

//mODIFICAR TIEMPOS DE SUBIDA DEL ARCHIVO

