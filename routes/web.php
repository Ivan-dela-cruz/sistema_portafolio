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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');

//Ruta para consultar el formulario que servira para la actualizacion de sus datos
    Route::get('editar_perfil_docente', 'UsuarioController@editarPerfilDocente');


//Ruta para consultar el formulario de portafolio

    Route::get('consultar_portafolio', 'PortafoliosController@consultarPortafolio')->middleware("roleshinobi:docente");

//Ruta para consultar el formulario de parametro

    Route::get('gestion_parametro', 'ParametroController@consultarParametro')->middleware("roleshinobi:vicedecano");

//Ruta editar educacion Docentes
    Route::get('estudios_docente', 'TitulosController@estudiosDocente');

//Ruta para actualizar estudio del docente

    Route::get('actualizar_estudios_docente', 'TitulosController@actualizarEstudiosDocente');

//Ruta para actualizar parametro que óseen en P.A. Silabo
    Route::post('actualizar_parametro', 'ParametroController@update')->middleware("roleshinobi:vicedecano");

//Ruta para procesar el actualizado de los datos

    Route::post('editar_docente', 'UsuarioController@editarDocente');

    Route::post('cambiar_historial', 'UsuarioController@editarHistorial');

//Ruta para subir imagen

    Route::post('subir_imagen', 'UsuarioController@subirImagen');

// Ruta para cambiar clave usuario

    Route::post('cambiar_clave', 'UsuarioController@cambiarClave');

    Route::post('/agregar_titulo', 'TitulosController@agregarTitulo');

    Route::get('borrar_titulo/{id}', 'TitulosController@eliminarTitulo');

    Route::get('borrar_parametro/{id}', 'ParametroController@delete')->middleware("roleshinobi:vicedecano");

//Controlador permite buscar portafolios de acuerdo al periodo academico

    Route::get('buscar_portafolio_docente/{idPeriodo}', 'PortafoliosController@buscarPortafolioXPeriodo')->middleware("roleshinobi:docente");

//Controlador para Crear PORTAFOLIO
    Route::post('crear_portafolio', 'PortafoliosController@crearPortafolio')->middleware("roleshinobi:docente");

//Controlador para Crear PARAMETRO
    Route::post('crear_parametro', 'ParametroController@crearParametro')->middleware("roleshinobi:vicedecano");

//Controlador sirve para registrar materias en el portafolio
    Route::get('/materias_portafolio/{idPor}', 'PortafoliosController@materiasPortafolio')->middleware("roleshinobi:docente");

//PERMITE MOSTRAR LAS MATERIAS PO CARRERA Y CICLO
    Route::get('cargar_materia/{idCic}/{idCar}', 'PortafoliosController@cargarMateria')->middleware("roleshinobi:docente");

//PERMITE AGREAGAR MATERIA AL PORTAFOLIO

    Route::post('/agregar_materia_portafolio', 'PortafoliosController@agregarMateriaPortafolio')->middleware("roleshinobi:docente");

//Para mostrar las materia que poseen el portafolio seleccionado
    Route::get('materia_registrada_portafolio/{idPor}', 'PortafoliosController@materiaRegistradaPortafolio')->middleware("roleshinobi:docente");

//Para mostrar los parametros que poseen el portafolio
    Route::get('/listado_parametro', 'ParametroController@parametroRegistradaPortafolio')->middleware("roleshinobi:vicedecano");

//Para visualzar los parametros que contienen cada una de las materias
    Route::get('parametros_asignatura/{idMatPor}', 'PortafoliosController@parametrosAsignatura')->middleware("roleshinobi:docente");

//Para subir los archivos Pdf

    Route::post('subir_archivoPdf', 'DocumentoController@subirArchivoPdf')->middleware("roleshinobi:docente");

//Subir archivoa parametros asignaturas

    Route::post("subir_ParametroMat", "DocumentoController@subirArchivoPdfParametro")->middleware("roleshinobi:docente");

//Subir parametro portafolio
    Route::post("subir_ParametroPorta", "DocumentoController@subirArchivoPdfParametroPorta")->middleware("roleshinobi:docente");

//Para generar el pdf Fucionado unir varios Pdf
    Route::get('generar_pdf/{idPorMat}', 'DocumentoController@generarPdfConsolidado');

//Para la salida del pdf Fucionado
    // Route::get('salida_pdf_fucionado/{idPorMat}', 'DocumentoController@salidaPdfFusionado');

//Ruta que me permite descargar archivos Pdf de los parametros Producto

    Route::get('descargar_pdf/{idDocu}', 'DocumentoController@descargarPdf');

//Perimite Descargar los archivos Pdf de los parametrso Asignatura
    Route::get("descargar_pdf_Mate/{idDoc}", "DocumentoController@descargarPdfParametroMat");

//Permite descargar los arcchivos PDF  de los parametros Portafolio
    Route::get("descargar_pdf_Porta/{idDoc}", "DocumentoController@descargarPdfParametroPorta");

//Descarga el pedf de las actividades
    Route::get("descargar_pdf_actividad/{idDocu}", "ActividadController@descargarPdfActividad");

//Route::get('reportes', 'PDFController@index');

//Ruta para visualizar elpdf
    Route::get('getPDF/{id}', 'PDFController@get');

// Ruta para descargar pdf
    Route::get('descargarPDF/{id}', 'PDFController@descargar');

//Listado Docente
    Route::get('lista_docente', 'UsuarioController@listaDocente')->middleware("roleshinobi:director");

//Buscar docentes x carrera y apellido , nombre 0 cedula

    Route::get('buscar_listado_docente/{idPer}/{idCar}/{dato?}', 'UsuarioController@buscarListadoDocente')->middleware("roleshinobi:director");

//Ruta para el reporte cumplimiento del docente

    Route::get('reporte_cumplimiento/{idPor}', 'PortafoliosController@reporteCumplimiento')->middleware("roleshinobi:director");

//Route::get('reporte', 'PortafoliosController@reportes');

    Route::get('generar_reporte_cumplimiento/{idPorta}/{idPorMat}', 'PDFController@generarReporteCumplimiento')->middleware("roleshinobi:director");

//Ruta actualizar Parametro es decir refresca la pagina para mostrar todos los parametros que poseen las asgnaturas al momento de subir

    Route::get('actualizar_parametro/{idPorMat}', 'PortafoliosController@actualizarParametro')->middleware("roleshinobi:docente");

//Ruta para actualizar los archvos PDF DE LOS PARAMETROS AL MOMENTO DE SUBIR ARCHIvO regfrecar  solo la parte de los parametros portafolio
    Route::get('actualizar_parametro_porta/{idPorta}', 'DocumentoController@actualizarParametroPorta')->middleware("roleshinobi:docente");

//Ruta para consultar el formulario de periodo
    Route::get('gestion_periodo', 'PeriodosController@index')->middleware("roleshinobi:vicedecano");

//Para mostrar los periodoos que poseen el portafolio
    Route::get('/periodo', 'PeriodosController@listaPeriodoRegistradoPortafolio')->middleware("roleshinobi:vicedecano");

//Ruta para actulizar periodo Academicos
    Route::Post('actualizar_periodo', 'PeriodosController@actualizarPeriodo')->middleware("roleshinobi:vicedecano");

//Controlador para Crear Periodo
    Route::post('crear_periodo', 'PeriodosController@crearPeriodo')->middleware("roleshinobi:vicedecano");
//Permite verficar los documentos subidos por el docente

    Route::get('reporte_verificacion/{idPorta}/{idPorMat}', 'PDFController@reporteVerificacion')->middleware("roleshinobi:director");

//Eliminar archivo  paramemteros producuto  del servidor
    Route::get('/eliminar_Pdf/{idArchivo}', 'PDFController@eliminarPdfProducto')->middleware("roleshinobi:director");

    //Elimina archivos Pdf de los parametros portafolio del servidro
    Route::get("/eliminar_Pdf_portafolioDocente/{idArchivo}", "PortafoliosController@eliminarPdfParametroPortaDocente")->middleware("roleshinobi:docente");

//Elimina archivos Pdf de los parametros portafolio del servidro
    Route::get("/eliminar_Pdf_portafolio/{idArchivo}", "PDFController@eliminarPdfParametroPorta")->middleware("roleshinobi:director");

//Eliminar Pdf de los parameros Asignaturas
    Route::get("/eliminar_Pdf_materia/{idArchivo}", "PDFController@eliminarPdfParametroMate")->middleware("roleshinobi:director");

//Eliminar Pdf actividades

    Route::get("/eliminar_pdf_actividad/{idArchivo}", "PDFController@eliminarPdfActividad")->middleware("roleshinobi:director");

    Route::get("listado_usuario", "UsuarioController@listadoUsuario")->middleware("roleshinobi:vicedecano");
//Ver lista de rol
    Route::get("asignar_rol_usuario/{idUser}", "UsuarioController@rolUsuario")->middleware("roleshinobi:vicedecano");
//Asignar rol al usuario
    Route::get("asignar_rol/{idusu}/{idrol}", "UsuarioController@asignarRolUsuario")->middleware("roleshinobi:vicedecano");
//para quitar el rol que esta asignado el usurio

    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuarioController@quitar_rol')->middleware("roleshinobi:vicedecano");

//para editar acceso usuario
    Route::post('editar_acceso', 'UsuarioController@editarAcceso')->middleware("roleshinobi:vicedecano");

    Route::post('asignar_director_carrera', 'UsuarioController@asignarDirectorCarrera')->middleware("roleshinobi:vicedecano");

//para buscar usuarios de acuerdo a su rol o a un datos

    Route::get('buscar_usuario_rol/{idRol}/{dato?}', 'UsuarioController@buscarUsuarioRol')->middleware("roleshinobi:vicedecano");

    Route::get('buscar_usuario_invitado/{idRol}/{dato?}', 'UsuarioController@buscarUsuarioInvitado')->middleware("roleshinobi:vicedecano");

    Route::get('eliminar_usuario/{idUsu}', 'UsuarioController@eliminarUsuario')->middleware("roleshinobi:vicedecano");

    Route::get('otras_actividades', 'ActividadController@otrasActividades')->middleware("roleshinobi:docente");
    //Buscar actividad
    Route::get('buscar_actividad/{idPeriodo}/{idCarrera}', 'ActividadController@buscarActividad')->middleware("roleshinobi:docente");

    //VISUALIRAR LOS ARCCIVOS DE LOS PORTAFOLIOS
    Route::get('archivo_actividad/{idPor}', 'ActividadController@archivoActividad')->middleware("roleshinobi:docente");
//Mostrar archivo docente
    Route::get("mostrar_archivo_actividad/{idPorta}/{idCat}", "ActividadController@mostrarArchivoActividad")->middleware("roleshinobi:docente");

//Mostrar archivo director

    Route::get("mostrar_archivo_actividad_director/{idPorta}/{idCat}", "ActividadController@mostrarArchivoActividadDirector")->middleware("roleshinobi:director");

    Route::post("subir_archivo_actividad", "ActividadController@subirArchivoActividad")->middleware("roleshinobi:docente");
//Visualizar los archivos y reportes actividad
    Route::get("reporte_actividad/{idPorta}", "ActividadController@actividadReporteDocente")->middleware("roleshinobi:director");

    Route::get("generar_reporte_actividad/{idPorta}", "ActividadController@generarReporteActividad")->middleware("roleshinobi:director");


    //Controlador para habilitar el tiempo de subida de los documentos
    Route::post('habilitar_subida_documentos', 'PeriodosController@habilitarSubidaDocumetos')->middleware("roleshinobi:docente");

    //Ruta para consultar el formulario de habilitar el tiempo de subida de los documentos

    Route::get('modificar_subida_documentos', 'PeriodosController@listarPeriodoAcademico')->middleware("roleshinobi:docente");


    ///ruta para gestionar los tiempos de y fechas de las portada y los parametros academicos
    Route::get('busqueda-tiempo/{id}', 'PeriodosController@getTiempoFechaPeriodo')->middleware('roleshinobi:docente');
    //Eliminar Pdf de los parameros Asignaturas vista docente
    Route::get("/eliminar_Pdf_asignatura/{idArchivo}", "PDFController@eliminarPdfParametroAsignaturaDocente")->middleware("roleshinobi:docente");
    //Eliminar archivo  paramemteros producuto  del servidor mediante el rol de docente
    Route::get('/eliminar_Pdf_producto/{idArchivo}', 'PDFController@eliminarPdfProductoDocente')->middleware("roleshinobi:docente");


    //Ruta para consultar el formulario de portafolio

    Route::get('crear_materia', 'MateriaController@create')->name('crear_materia')->middleware("roleshinobi:director");

    //PERMITE AGREAGAR MATERIA AL PORTAFOLIO

    Route::post('/agregar_nueva_materia_portafolio', 'MateriaController@store')->middleware("roleshinobi:director");

    //Ruta para paginar mediante ajax la vista de las materias

    Route::get('pagina-materias', 'MateriaController@paginacionMateria')->middleware("roleshinobi:director");

    //Route::get('modificar_materia', 'MateriaController@edit')->middleware("roleshinobi:director");
    Route::get('modificar_materia/{id}', 'MateriaController@edit')->middleware("roleshinobi:director");
    Route::resource('materiasLista', 'MateriaController');
    Route::post('cambiar_datos_materia', 'MateriaController@updateMateria')->middleware("roleshinobi:director");
    Route::delete('eliminar-materia', 'MateriaController@destroy')->name('eliminar-materia')->middleware("roleshinobi:director");


    Route::get('refrescar-tabla-productos', 'Producto_AcademicoController@refreshTable')->name('refrescar-tabla-productos')->middleware('roleshinobi:director');

    Route::get('productos-academicos', 'Producto_AcademicoController@index')->name('productos-academicos')->middleware('roleshinobi:director');

    Route::post('producto-store', 'Producto_AcademicoController@store')->name('producto-store')->middleware('roleshinobi:director');
    Route::put('producto-update', 'Producto_AcademicoController@update')->name('producto-update')->middleware('roleshinobi:director');
    Route::delete('producto-destroy', 'Producto_AcademicoController@destroy')->name('producto-destroy')->middleware('roleshinobi:director');


    ///RUTAS PARA LOS INSUMOS
    Route::get('insumos-docentes', 'InsumosController@vistaDocentes')->name('insumos-docentes')->middleware('roleshinobi:docente');
    //--------CONTOLADOR DE RECURSOS DE LOS INSUMOS PARA EL ADMINISTRADOR O ROL DIRECTOR------------
    Route::get('crear-insumos', 'InsumosController@create')->name('crear-insumos')->middleware('roleshinobi:director');
    Route::post('guardar-insumos', 'InsumosController@store')->name('guardar-insumos')->middleware('roleshinobi:director');
    Route::get('index-insumos','InsumosController@index')->name('index-insumos')->middleware('roleshinobi:director');
    Route::get('insumos','InsumosController@insumosDocentes')->name('insumos')->middleware('roleshinobi:docente');
});
