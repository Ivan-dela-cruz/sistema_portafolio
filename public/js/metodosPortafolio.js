



function cargarMateria(idCic){
	var idCarrera=$("#carrera").val();
if(idCic==""){
idCic=0;	
}
var url="/cargar_materia/"+idCic+"/"+idCarrera;
$("#resultadoMateria").html($("#cargando").html());
$.get(url,function(result){
$("#resultadoMateria").html(result);
});
}




function materiasCreadas(){
	var idPortafolio=$("#portafolio").val();

var url="/materia_registrada_portafolio/"+idPortafolio;
$("#notificacionAgregarMateria").html($("#cargando").html());
$.get(url,function(result){
	$("#notificacionAgregarMateria").html(result);
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




function verParametro(idMatPorta){
window.location="/parametros_asignatura/"+idMatPorta;

}






//Para asiganar el id del parametro para subir el archivo

	
function getIdParametro(idParametro, nombre){
document.getElementById("documento").value=idParametro;
document.getElementById("descripcion").value=nombre;
}






function generar(){
  idPorMat=$("#idPorMat").val();

var url="/generar_pdf/"+idPorMat;
$("#consolidar").html($("#cargando").html());
$.get(url,function(result){
	$("#consolidar").html(result);
});

}