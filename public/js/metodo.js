function irarriba(){
$('html, body').animate({scrollTop:0}, 300);
}



function getpdf(){

var url="lista_reportes";
//alert(url);
actualizarPagina(url);
    
}


function get(listado){
  //funcion para cargar los diferentes  en general
  if(listado==3){ var url = "reportes"; }

var idDoc=$("#docente").val();
var idTip=$("#tipo").val();


var url2=url+"/"+idDoc+"/"+idTip;

$("#contenido_principal").html($("#cargando").html());
$.get(url,function(resul){
        $("#contenido_principal").html(resul); 
})
}




//Verificar estudios y titulos obtenidos
function estudiosRealizados(){
var url="/frm_editar_estudio_docente";
actualizarPagina(url)
}


function actualizarPagina(vUrl){
//Id Del Docente logueado
var idDoc=$("#docente").val();
var url=vUrl+"/"+idDoc;
//alert (url);
$("#contenido_principal").html($("#cargando").html());
$.get(url, function(result){
$("#contenido_principal").html(result);
});
}

//Buscar portafolios Academico docentes

function buscarPortafolio(){
var periodo=$("#periodoBuscar").val();

 // alert("hola"+periodo);
var url="buscar_portafolio_docente/"+periodo+"";
  $("#rsPortafolio").html($("#cargando").html());
 $.get(url,function(resul){
    $("#rsPortafolio").html(resul);  
  })

}


//Elimina el titulo del docente logeado
function borrarTitulo(idTit){
 swal({
  title: "Estás Seguro?",
  text: "Desea eliminar educación docente.!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Si, Borrar!",
  cancelButtonText: "No, Cancelar!",
  closeOnConfirm: false,
  closeOnCancel: false
},

function(isConfirm) {
  if (isConfirm) {
   var url="borrar_titulo/"+idTit;
var nota="notaBorrar";
$("#"+nota+"").html($("#cargando").html());
$.get(url, function(result){
$("#"+nota+"").html(result);
//Se carga la pagina en un tiempo
//setTimeout( "estudiosRealizados()",1000);
estudiosRealizados();

});
    swal("Eliminado!", "Educación se ha eliminado correctamente.", "success");

  } else {
    swal("Cancelado!", "Desea cancelar la operacion:)", "error");

  }
});

}

function mostrarseccion(num){
  var id_usuario=$("#usuario_seleccionado").val(); 
  //$("#seccion_seleccionada").val(num);//Este parece que no hace nada
  
  if(num==1){ var url = "form_editar_usuario/"+id_usuario+""; }
  if(num==2){ var url = "form_educacion_usuario/"+id_usuario+""; } 
  if(num==3){ var url = "form_publicaciones_usuario/"+id_usuario+""; } //leccion 11
  $("#contenido_capa_edicion").html($("#cargando").html());
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);
  })
}

//Actulizar perfil docente  


 $(document).on("submit",".form_entrada",function(e){
//funcion para atrapar los formularios y enviar los datos
       e.preventDefault();
        $('html, body').animate({scrollTop: '0px'}, 200);
        var formu=$(this);
        var quien=$(this).attr("id");

        //Para limpiar el formulario dependiemdo del formulario
        var res=false; 
   var cual=0;
       if(quien=="frm_editar_docente"){ var varurl="editar_docente"; var divresul="notificacion"; }

       if (quien=="frm_cambiar_clave") { var varurl ="cambiar_clave"; var divresul="notificacion_cambiarClave";}

       if (quien=="frm_agregar_titulo") { var varurl="agregar_titulo";  var divresul="notaEstudio";  res=true; cual=1;}
       if (quien=="frm_cambiar_historial") { var varurl="cambiar_historial";    var divresul="notificacion_cambiarHistorial"; }
      
       if (quien=="frm_crear_portafolio") { var varurl="crear_portafolio";  var divresul="notificacion_crear_portafolio";
     res=true;
     }

if (quien=="frm_agregar_materia_portafolio") {  var varurl="/agregar_materia_portafolio"; var divresul="notificacionAgregarMateria";}



        $("#"+divresul+"").html($("#cargando").html());
              $.ajax({
                    type: "POST",
                    url : varurl,
                    datatype:'json',
                    data : formu.serialize(),
                    success : function(resul){
                        $("#"+divresul+"").html(resul);
if(res){
$('#'+quien+'').trigger("reset");
}


if (cual==1) {
//Se carga la pagina  llamado al metodo estudiosRealizadas en un tiempo
setTimeout( "estudiosRealizados()",1000);


}




                    }
                });

});


 //Subir imagen docente
//y
//Subir archivo

  $(document).on("submit",".formarchivo",function(e){

    
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");

        var rs=false; 
        //var seccion_sel=  $("#seccion_seleccionada").val();
    
        if(nombreform=="frm_subir_imagen" ){ 
          var miurl="subir_imagen"; 
           var divresul="notificacionImagen";  
            rs="foto";
            }

if (nombreform=="frm_subir_archivoPdf") {
var miurl="/subir_archivoPdf";
var divresul="notaPdf";
    rs="subir";
  
}

        //Para obtener la informacion del archivo..
        var formData = new FormData($("#"+nombreform+"")[0]);
          $.ajax({
            url: miurl,  
            type: 'POST',
            //pra pasar los datos del archivo
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
              $("#"+divresul+"").html($("#cargando").html());                
            },
            //una vez finalizado correctamente
            success: function(data){
              $("#"+divresul+"").html(data);
              
     //Para Actualizar en ese momento la imagen
              if (rs=="foto") {
              $("#fotografia_usuario").attr('src', $("#fotografia_usuario").attr('src') + '?' + Math.random() ); 
                
                }
    

    //Agregar para subir archivo Pdf

            if (rs=="subir"){
//Obtengo el id materia que posee losi  parametros correspomdiente
            idPorMat=$("#idPorMat").val();

                  $('#'+nombreform+'').trigger("reset"); 

                  setTimeout( "verParametro('"+idPorMat+"')",1500);


                   }


            },


            
            //si ha ocurrido un error
            error: function(data){
               alert("Ha ocurrido un error vuelva a intentar..") ;
                
            }
        });

        irarriba();
    });


