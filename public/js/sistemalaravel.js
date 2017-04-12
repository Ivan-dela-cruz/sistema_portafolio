function irarriba(){
$('html, body').animate({scrollTop:0}, 300);
}


function cargarformulario(arg){
//funcion que carga todos los formularios del sistema

  if(arg==1) { var url = "form_nuevo_usuario"; }
 if(arg==2) { var url = "form_cargar_datos_usuarios"; }
   if(arg==3) { var url = "form_enviar_correo";  }
    $("#contenido_principal").html($("#cargador_empresa").html());
       
        $.get(url,function(resul){
            $("#contenido_principal").html(resul);
        })
}


function cargarlistado(listado){
var hoy = new Date();
var dia = hoy.getDate();
var mes = hoy.getMonth()+1; //hoy es 0!
var anio = hoy.getFullYear();


    //funcion para cargar los diferentes  en general

    //Cargar listado estudiantes 
if(listado==1)
  { var url = "listado_usuarios"; }

//Cargar listado publicaciones


//el cero aqui es opcional pero no esta ciendo nada se podria utilizar para fitrar las publicaciones
//Categoria
if(listado==2){ var url = "listado_publicaciones/0"; }

if(listado==4){ var url = "listado_graficas"; }
$("#contenido_principal").html($("#cargador_empresa").html());
$.get(url,function(resul){
        $("#contenido_principal").html(resul); 
})
}



 $(document).on("submit",".form_entrada",function(e){
//funcion para atrapar los formularios y enviar los datos
       e.preventDefault();
        $('html, body').animate({scrollTop: '0px'}, 200);
        var formu=$(this);
        var quien=$(this).attr("id");

        //Para limpiar el formulario dependiemdo del formulario
        var rs=false; //leccion 10
        //Muestra la seccion selecionada
        var seccion_sel=  $("#seccion_seleccionada").val();
      
        if(quien=="f_nuevo_usuario"){ 
          var varurl="agregar_nuevo_usuario"; 
          var divresul="notificacion_resul_fanu";
          rs=true;
        }
        
        if(quien=="f_editar_usuario"){ var varurl="editar_usuario"; var divresul="notificacion_resul_feu"; }
        if(quien=="f_cambiar_password"){ var varurl="cambiar_password"; var divresul="notificacion_resul_fcp";  }
        if(quien=="f_agregar_educacion"){ var varurl="agregar_educacion_usuario"; var divresul="notificacion_resul_faedu";  rs=true; }  //leccion 10
        $("#"+divresul+"").html($("#cargador_empresa").html());
              $.ajax({
                    type: "POST",
                    url : varurl,
                    datatype:'json',
                    data : formu.serialize(),
                    success : function(resul){
                        $("#"+divresul+"").html(resul);
                        if(rs ){
                         $('#'+quien+'').trigger("reset");
                         //Vuelve a cargar la sesio seleccionada
                         mostrarseccion(seccion_sel);
                        }
                    }
                });
});



$(document).on("click",".pagination li a",function(e){
//para que la pagina se cargen los elementos
 e.preventDefault();
 var url =$( this).attr("href");
 $("#contenido_principal").html($("#cargador_empresa").html());
 $.get(url,function(resul){
    $("#contenido_principal").html(resul); 
 
 })

})





  //leccion 7 
function mostrarficha(id_usuario,tipo) {
  //funcion para mostrar y etditar la informacion del usuario
 
  $("#usuario_seleccionado").val(id_usuario); // leccion10
  $("#capa_modal").show();
  $("#capa_para_edicion").show();
  if(tipo==1){
    var url = "form_editar_usuario/"+id_usuario+""; }
    else{ 
      var url = "info_datos_usuario/"+id_usuario+""; 
    }
  $("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);  //leccion 10
  })
irarriba();
}







(document).on("click",".div_modal",function(e){
 //funcion para ocultar las capas modales
 $("#capa_modal").hide();
 $("#capa_para_edicion").hide();
 $("#contenido_capa_edicion").html("");  //leccion 10

}) 











//Subir imagen y subir archivo excel




  $(document).on("submit",".formarchivo",function(e){

     
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");

        var rs=false; //leccion 10
        var seccion_sel=  $("#seccion_seleccionada").val();
        if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci";   }
        if(nombreform=="f_cargar_datos_usuarios" ){ var miurl="cargar_datos_usuarios";  var divresul="notificacion_resul_fcdu"; rs=true; }
        if(nombreform=="f_agregar_publicacion" ){ var miurl="agregar_publicacion_usuario";  var divresul="notificacion_resul_fap"; rs=true; }
        if(nombreform=="f_agregar_proyectos" ){ var miurl="agregar_proyectos_usuario";  var divresul="notificacion_resul_fapr"; rs=true; }
        if(nombreform=="f_enviar_correo" ){ var miurl="enviar_correo";  var divresul="contenido_principal";   }


        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);

        //hacemos la petición ajax   
        $.ajax({
            url: miurl,  
            type: 'POST',
     
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
              $("#"+divresul+"").html($("#cargador_empresa").html());                
            },
            //una vez finalizado correctamente
            success: function(data){
              $("#"+divresul+"").html(data);
              //Para Actualizar en ese momento la imagen
              $("#fotografia_usuario").attr('src', $("#fotografia_usuario").attr('src') + '?' + Math.random() );               
                         if(rs ){
                         $('#'+nombreform+'').trigger("reset");
                         mostrarseccion(seccion_sel);
                        } 
            },
            //si ha ocurrido un error
            error: function(data){
               alert("ha ocurrido un error") ;
                
            }
        });

        irarriba();
    });



//leccion  10
 

 //Muestra la seccion seleccionnada ya sea informacion O Educacion  o Publicaciones 
function mostrarsecciond(num){
  var id_usuario=$("#usuario_seleccionado").val(); 
  //$("#seccion_seleccionada").val(num);//Este parece que no hace nada
  
  if(num==1){ var url = "form_editar_usuario/"+id_usuario+""; }
  if(num==2){ var url = "form_educacion_usuario/"+id_usuario+""; } 
  if(num==3){ var url = "form_publicaciones_usuario/"+id_usuario+""; } //leccion 11
  $("#contenido_capa_edicion").html($("#cargador_empresa").html());
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);
  })

}



//leccion 16 para mostrar privilegios del usuario estandar
function mostrarseccionSTD(arg){

  var id_usuario=$("#usuario_seleccionado").val(); 
  $("#seccion_seleccionada").val(arg);
  if(arg==1){ var url = "info_datos_usuario/"+id_usuario+""; }
  $("#contenido_capa_edicion").html($("#cargador_empresa").html());
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);
  })

}





function borrareducacion(idEdu){

var url="borrar_educacion/"+idEdu+"" ;
var divresul="notificacion_resul_edu";
$("#"+divresul+"").html($("#cargador_empresa").html());

$.get(url,function(resul){
  $("#"+divresul+"").html(resul);
  //Refresaca la sesion 2 seleccionada con las categorias nuevas agregadas  
  mostrarseccion(2);
})
}






//pErmite seleccionar una opcion del combox para verificar si es un articulo o un libro
//Lo oculta o lo muesta
function mostrardiv_publicaciones(tipoPublicacion){
  $("#info_libro").hide();
  $("#info_revista").hide();
  if(tipoPublicacion==5){ $("#info_libro").show(); $("#info_revista").hide();  } 
  if(tipoPublicacion==4){ $("#info_libro").hide(); $("#info_revista").show();  } 

}

function borrarpublicacion(idPub){
  //Eliminar publicaciones
var url="borrar_publicacion/"+idPub+"" ;
var divresul="notificacion_resul_fapu";
$("#"+divresul+"").html($("#cargador_empresa").html());

$.get(url,function(resul){
  $("#"+divresul+"").html(resul);
  mostrarseccion(3);
  cargarlistado(2,1);
});
}



 function buscarusuario(){
  var pais=$("#select_filtro_pais").val();
  var dato=$("#dato_buscado").val();


//Para que no ejecute error cuando existe espacios en blanco obligatorio y probado

      if(dato.trim()==""){
        //Si el dato es vacio y solo se eligio pais envia solo i del pais 
        //Porque el dato solo es opcional es decir que puee existrir o no 
     var url="buscar_usuarios/"+pais+"";
    }
    else
    {
      //Buscat  usuario tanto el dato como el pais 
      var url="buscar_usuarios/"+pais+"/"+dato+"";
    }
  
  $("#contenido_principal").html($("#cargador_empresa").html());
 $.get(url,function(resul){
    $("#contenido_principal").html(resul);  
  })

}




//Para gargar el elemento que se va adjuntar en el coreeo  primero debems guaradr el archivo en el servidor  
//para luego ser enviado


//leccion 13
//Este evento ocurre cuando seleccionamos algun elemento

$(document).on("change",".email_archivo",function(e){
    var miurl="cargar_archivo_correo";
   // var fileup=$("#file").val();
    var divresul="texto_notificacion";

//Es cuando envio un archivo y no  todo el formulario 
//creo una instancia del archivo
    var data = new FormData();
    data.append('file', $('#file')[0].files[0] );
    console.log(data);

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#_token').val()
        }
    });



     $.ajax({
            url: miurl,  
            type: 'POST',
            // Form data
            //datos del formulario
            data: data,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
              $("#"+divresul+"").html($("#cargador_empresa").html());                
            },
            //una vez finalizado correctamente
            success: function(data){

              //Para mostrar el archivo cargado...
              //el dato que viene del servido
              //La respuesta es el nombre del archivo que se guardo en el servidor para ser enviado
              var codigo='<div class="mailbox-attachment-info"><a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>'+ data +'</a><span class="mailbox-attachment-size"> </span></div>';
              $("#"+divresul+"").html(codigo);
            },
            //si ha ocurrido un error
            error: function(data){
               $("#"+divresul+"").html(data);
            }
        });



});









