function cargarMateria(idCic) {
    var idCarrera = $("#carrera").val();
    if (idCic == "") {
        idCic = 0;
    }
    var url = "/cargar_materia/" + idCic + "/" + idCarrera;
    $("#resultadoMateria").html($("#cargando").html());
    $.get(url, function(result) {
        $("#resultadoMateria").html(result);
    });
}

function materiasCreadas() {
    var idPortafolio = $("#portafolio").val();
    var url = "/materia_registrada_portafolio/" + idPortafolio;
    $("#notificacionAgregarMateria").html($("#cargando").html());
    $.get(url, function(result) {
        $("#notificacionAgregarMateria").html(result);
    });
}

function parametrosCreados() {
    var url = "/listado_parametro";
    $("#rsListaParametro").html($("#cargando").html());
    $.get(url, function(result) {
        $("#rsListaParametro").html(result);
    });
}

function periodosCreados() {
    var url = "/periodo";
    $("#rsPeriodoAcademicoAll").html($("#cargando").html());
    $.get(url, function(result) {
        $("#rsPeriodoAcademicoAll").html(result);
    });
}
//Rediccionzar automaticamente  en 5 segundo a otra direccion comprobado  pegar en la vista al inicio
//<head>
//<script>
//alert('Te estaremos redireccionando a www.web-de-destino.com en 5 segunditos');
//function redireccionar(){window.location="http://www.web-de-destino.com";}
//setTimeout ("redireccionar()", 5000);
//</script>
//</head>
//pARA ue se actualice los parametros que posee la asignatura en el momento de subir Pdf
function actualizarParametro() {
    // window.location = "/parametros_asignatura/" + idMatPorta;
    var idPorMat = document.getElementById("idPorMat").value;
    var url = "/actualizar_parametro/" + idPorMat;
    $("#contenido_principal").html($("#cargando").html());
    $.get(url, function(resul) {
        //alert("cccc");
        $("#contenido_principal").html(resul);
    })
}
//Para actualizar los para metros de los portafolios cuando subo un archivo Pdf
function actualizarParametroPorta() {
    // window.location = "/parametros_asignatura/" + idMatPorta;
    //ID DEL PORTAFOLIO
    var idPorta = document.getElementById("idPorta").value;
    var url = "/actualizar_parametro_porta/" + idPorta;
    $("#rsParametroPorta").html($("#cargando").html());
    $.get(url, function(resul) {
        //alert("cccc");
        $("#rsParametroPorta").html(resul);
    })
}
//Para asiganar el id del parametro para subir el archivo parametros Productos
function getIdParametro(idParametro, nombre) {
    document.getElementById("documento").value = idParametro;
    document.getElementById("descripcion").value = nombre;
}
//Para guardar los parametros de la asignaturas
function getIdParametro2(idParametro, nombre) {
    document.getElementById("documento2").value = idParametro;
    document.getElementById("descripcion2").value = nombre;
}
//Para guardar los parametros del portafolio
function getIdParametro3(idParametro, nombre) {
    document.getElementById("documento2").value = idParametro;
    document.getElementById("descripcion2").value = nombre;
}
//Eliminar archivos parametros productos academico
function eliminarArchivo(idArchivo) {
    swal({
        title: "Estás Seguro?",
        text: "Desea eliminar archivo.!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            var url = "/eliminar_Pdf/" + idArchivo;
            $("#rsParametro").html($("#cargando").html());
            $.get(url, function(result) {
                $("#rsParametro").html(result);
            });
            swal("Eliminado!", "Archivo se ha eliminado correctamente.", "success");
        } else {
            swal("Cancelado!", "Desea cancelar la operacion", "error");
        }
    });
}
//Eliminar archivo parametros portafolio
function eliminarArchivoParametroPorta(idArchivo) {
    swal({
        title: "Estás Seguro?",
        text: "Desea eliminar archivo.!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            var url = "/eliminar_Pdf_portafolio/" + idArchivo;
            $("#rsParametroPorta").html($("#cargando").html());
            $.get(url, function(result) {
                $("#rsParametroPorta").html(result);
            });
            swal("Eliminado!", "Archivo se ha eliminado correctamente.", "success");
        } else {
            swal("Cancelado!", "Desea cancelar la operacion", "error");
        }
    });
}
//Eliminar archivos patametros materia
function eliminarArchivoParametroMat(idArchivo) {
    swal({
        title: "Estás Seguro?",
        text: "Desea eliminar archivo.!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            var url = "/eliminar_Pdf_materia/" + idArchivo;
            $("#rsParametroMat").html($("#cargando").html());
            $.get(url, function(result) {
                $("#rsParametroMat").html(result);
            });
            swal("Eliminado!", "Archivo se ha eliminado correctamente.", "success");
        } else {
            swal("Cancelado!", "Desea cancelar la operacion", "error");
        }
    });
}