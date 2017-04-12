<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/login', function () {
    return view('Auth/login');
});



Auth::routes();

Route::get('/home', 'HomeController@index');



//Ruta para consultar el formulario que servira para la actualizacion de sus datos
Route::get('editar_perfil_docente','UsuarioController@editarPerfilDocente');


//Ruta para consultar el formulario de portafolio


Route::get('consultar_portafolio','PortafoliosController@consultarPortafolio');


//Ruta editar educacion Docentes 
Route::get('frm_editar_estudio_docente/{id}','TitulosController@consultarEstudiosDoc');

//Ruta para procesar el actualizado de los datos

Route::post('editar_docente', 'UsuarioController@editarDocente');
Route::post('cambiar_historial','UsuarioController@editarHistorial');

//Ruta para subir imagen

Route::post('subir_imagen', 'UsuarioController@subirImagen');

// Ruta para cambiar clave usuario 

Route::post('cambiar_clave','UsuarioController@cambiarClave');

Route::post('agregar_titulo','TitulosController@agregarTitulo');

Route::get('borrar_titulo/{id}','TitulosController@eliminarTitulo');



//Controlador permite buscar portafolios de acuerdo al periodo academico

Route::get('buscar_portafolio_docente/{idPeriodo}', 'PortafoliosController@buscarPortafolioXPeriodo');


//Controlador para Crear PORTAFOLIO
Route::post('crear_portafolio','PortafoliosController@crearPortafolio');




//Controlador sirve para registrar materias en el portafolio
Route::get('/materias_portafolio/{idPor}','PortafoliosController@materiasPortafolio');


//PERMITE MOSTRAR LAS MATERIAS PO CARRERA Y CICLO
Route::get('cargar_materia/{idCic}/{idCar}','PortafoliosController@cargarMateria');


//PERMITE AGREAGAR MATERIA AL PORTAFOLIO

Route::post('/agregar_materia_portafolio','PortafoliosController@agregarMateriaPortafolio');

//Para mostrar las materia que poseen el portafolio seleccionado
Route::get('materia_registrada_portafolio/{idPor}','PortafoliosController@materiaRegistradaPortafolio');


//Para visualzar los parametros que contienen cada una de las materias
Route::get('parametros_asignatura/{idMatPor}','PortafoliosController@parametrosAsignatura');



//Para subir los archivos Pdf

Route::post('subir_archivoPdf','DocumentoController@subirArchivoPdf');

//Para generar el pdf Fucionado unir varios Pdf
Route::get('generar_pdf/{idPorMat}','DocumentoController@generarPdf');


//Para la salida del pdf Fucionado
Route::get('salida_pdf_fucionado/{idPorMat}','DocumentoController@salidaPdfFusionado');

//Ruta que me permite descargar archivos Pdf

Route::get('descargar_pdf/{idDocu}','DocumentoController@descargarPdf');


Route::get('reportes','PDFController@index');

//Ruta para visualizar elpdf
Route::get('getPDF/{id}', 'PDFController@get');

// Ruta para descargar pdf 
Route::get('descargarPDF/{id}','PDFController@descargar');

//Listado Docente 
Route::get('lista_docente','UsuarioController@listaDocente');

//Buscar docentes x carrera y apellido , nombre 0 cedula


Route::get('buscar_listado_docente/{idPer}/{idCar}/{dato?}','UsuarioController@buscarListadoDocente');


//Ruta para el reporte cumplimiento del docente

Route::get('reporte_cumplimiento/{idPor}','PortafoliosController@reporteCumplimiento');


Route::get('reporte','PortafoliosController@reportes');


Route::get('generar_reporte_cumplimiento/{idPorta}/{idPorMat}','PDFController@generarReporteCumplimiento');