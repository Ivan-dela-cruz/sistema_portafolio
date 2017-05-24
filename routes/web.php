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

Route::get('/', function () {
    //   return view('Auth/login');

    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Ruta para consultar el formulario que servira para la actualizacion de sus datos
Route::get('editar_perfil_docente', 'UsuarioController@editarPerfilDocente');

//Ruta para consultar el formulario de portafolio

Route::get('consultar_portafolio', 'PortafoliosController@consultarPortafolio');

//Ruta para consultar el formulario de parametro

Route::get('gestion_parametro', 'ParametroController@consultarParametro');

//Ruta editar educacion Docentes
Route::get('estudios_docente', 'TitulosController@estudiosDocente');

//Ruta para actualizar estudio del docente

Route::get('actualizar_estudios_docente', 'TitulosController@actualizarEstudiosDocente');

//Ruta para actualizar parametro que óseen en P.A. Silabo
Route::post('actualizar_parametro', 'ParametroController@update');

//Ruta para procesar el actualizado de los datos

Route::post('editar_docente', 'UsuarioController@editarDocente');
Route::post('cambiar_historial', 'UsuarioController@editarHistorial');

//Ruta para subir imagen

Route::post('subir_imagen', 'UsuarioController@subirImagen');

// Ruta para cambiar clave usuario

Route::post('cambiar_clave', 'UsuarioController@cambiarClave');

Route::post('agregar_titulo', 'TitulosController@agregarTitulo');

Route::get('borrar_titulo/{id}', 'TitulosController@eliminarTitulo');

Route::get('borrar_parametro/{id}', 'ParametroController@delete');

//Controlador permite buscar portafolios de acuerdo al periodo academico

Route::get('buscar_portafolio_docente/{idPeriodo}', 'PortafoliosController@buscarPortafolioXPeriodo');

//Controlador para Crear PORTAFOLIO
Route::post('crear_portafolio', 'PortafoliosController@crearPortafolio');

//Controlador para Crear PARAMETRO
Route::post('crear_parametro', 'ParametroController@crearParametro');

//Controlador sirve para registrar materias en el portafolio
Route::get('/materias_portafolio/{idPor}', 'PortafoliosController@materiasPortafolio');

//PERMITE MOSTRAR LAS MATERIAS PO CARRERA Y CICLO
Route::get('cargar_materia/{idCic}/{idCar}', 'PortafoliosController@cargarMateria');

//PERMITE AGREAGAR MATERIA AL PORTAFOLIO

Route::post('/agregar_materia_portafolio', 'PortafoliosController@agregarMateriaPortafolio');

//Para mostrar las materia que poseen el portafolio seleccionado
Route::get('materia_registrada_portafolio/{idPor}', 'PortafoliosController@materiaRegistradaPortafolio');

//Para mostrar los parametros que poseen el portafolio
Route::get('/listado_parametro', 'ParametroController@parametroRegistradaPortafolio');

//Para visualzar los parametros que contienen cada una de las materias
Route::get('parametros_asignatura/{idMatPor}', 'PortafoliosController@parametrosAsignatura');

//Para subir los archivos Pdf

Route::post('subir_archivoPdf', 'DocumentoController@subirArchivoPdf');

//Subir archivoa parametros asignaturas

Route::post("subir_ParametroMat", "DocumentoController@subirArchivoPdfParametro");

//Subir parametro portafolio
Route::post("subir_ParametroPorta", "DocumentoController@subirArchivoPdfParametroPorta");

//Para generar el pdf Fucionado unir varios Pdf
Route::get('generar_pdf/{idPorMat}', 'DocumentoController@generarPdfConsolidado');

//Para la salida del pdf Fucionado
Route::get('salida_pdf_fucionado/{idPorMat}', 'DocumentoController@salidaPdfFusionado');

//Ruta que me permite descargar archivos Pdf de los parametros Producto

Route::get('descargar_pdf/{idDocu}', 'DocumentoController@descargarPdf');

//Perimite Descargar los archivos Pdf de los parametrso Asignatura
Route::get("descargar_pdf_Mate/{idDoc}", "DocumentoController@descargarPdfParametroMat");

//Permite descargar los arcchivos PDF  de los parametros Portafolio
Route::get("descargar_pdf_Porta/{idDoc}", "DocumentoController@descargarPdfParametroPorta");

Route::get('reportes', 'PDFController@index');

//Ruta para visualizar elpdf
Route::get('getPDF/{id}', 'PDFController@get');

// Ruta para descargar pdf
Route::get('descargarPDF/{id}', 'PDFController@descargar');

//Listado Docente
Route::get('lista_docente', 'UsuarioController@listaDocente');

//Buscar docentes x carrera y apellido , nombre 0 cedula

Route::get('buscar_listado_docente/{idPer}/{idCar}/{dato?}', 'UsuarioController@buscarListadoDocente');

//Ruta para el reporte cumplimiento del docente

Route::get('reporte_cumplimiento/{idPor}', 'PortafoliosController@reporteCumplimiento');

//Route::get('reporte', 'PortafoliosController@reportes');

Route::get('generar_reporte_cumplimiento/{idPorta}/{idPorMat}', 'PDFController@generarReporteCumplimiento');

//Ruta actualizar Parametro es decir refresca la pagina para mostrar todos los parametros que poseen las asgnaturas al momento de subir

Route::get('actualizar_parametro/{idPorMat}', 'PortafoliosController@actualizarParametro');

//Ruta para actualizar los archvos PDF DE LOS PARAMETROS AL MOMENTO DE SUBIR ARCHIvO regfrecar  solo la parte de los parametros portafolio
Route::get('actualizar_parametro_porta/{idPorta}', 'DocumentoController@actualizarParametroPorta');

//Ruta para consultar el formulario de periodo
Route::get('gestion_periodo', 'PeriodosController@index');

//Para mostrar los periodoos que poseen el portafolio
Route::get('/periodo', 'PeriodosController@listaPeriodoRegistradoPortafolio');

//Ruta para actulizar periodo Academicos
Route::Post('actualizar_periodo', 'PeriodosController@actualizarPeriodo');

//Controlador para Crear Periodo
Route::post('crear_periodo', 'PeriodosController@crearPeriodo');
//Permite verficar los documentos subidos por el docente

Route::get('reporte_verificacion/{idPorta}/{idPorMat}', 'PDFController@reporteVerificacion');

//Eliminar archivo  paramemteros producuto  del servidor
Route::get('/eliminar_Pdf/{idArchivo}', 'PDFController@eliminarPdf');

//Elimina archivos Pdf de los parametros portafolio del servidro
Route::get("/eliminar_Pdf_portafolio/{idArchivo}", "PDFController@eliminarPdfParametroPorta");

//Eliminar Pdf de los parameros Asignaturas
Route::get("/eliminar_Pdf_materia/{idArchivo}", "PDFController@eliminarPdfParametroMate");
