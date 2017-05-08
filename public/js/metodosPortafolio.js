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
    var url = "/par";
    $("#notificacion_crear_parametro").html($("#cargando").html());
    $.get(url, function(result) {
        $("#notificacion_crear_parametro").html(result);
    });
}

function periodosCreados() {
    var url = "/periodo";
    $("#notificacion_crear_parametro").html($("#cargando").html());
    $.get(url, function(result) {
        $("#notificacion_crear_parametro").html(result);
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
//Modificar  los parametros
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
//Para asiganar el id del parametro para subir el archivo
function getIdParametro(idParametro, nombre) {
    document.getElementById("documento").value = idParametro;
    document.getElementById("descripcion").value = nombre;
}

function eliminarArchivo() {
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
            var idArchivo = document.getElementById("idDocumento").value;
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