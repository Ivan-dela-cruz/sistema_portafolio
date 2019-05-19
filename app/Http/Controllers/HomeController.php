<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Categoria;
use App\Paralelo;
use App\Producto_Academico;
use App\Tipo_Parametro;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->registrarParalelo();
        $this->registrarActividad();
        $this->registrarTipoParametro();
        $this->registrarProductoAcademico();
        return view('home');

    }

    public function registrarParalelo()
    {
        $verificarParalelo = Paralelo::all();
        if (!count($verificarParalelo)) {
            $this->procesarRegistroParalelo(1, "A");
            $this->procesarRegistroParalelo(2, "B");
            $this->procesarRegistroParalelo(3, "C");
            $this->procesarRegistroParalelo(4, "D");

        }
    }
    public function procesarRegistroParalelo($id, $nombre)
    {
        $paralelo         = new Paralelo;
        $paralelo->id     = $id;
        $paralelo->nombre = $nombre;
        $paralelo->save();
    }

    public function registrarActividad()
    {

        $verificarActividad = Actividad::all();
        if (!count($verificarActividad)) {
            $this->procesarRegistroCategoria(1, "Tutorías");
            $this->procesarRegistroCategoria(2, "Seguimiento a Graduados");
            $this->procesarRegistroCategoria(3, "Proyecto de Investigación");
            $this->procesarRegistroCategoria(4, "Producción Científica");
            $this->procesarRegistroCategoria(5, "Vinculación");
            $this->procesarRegistroCategoria(6, "Gestión");
//Registrar actividadad
            $this->procesarRegistroActividad(1, "Informes de Tutorías");
            $this->procesarRegistroActividad(1, "Informes de Tesis ");
            $this->procesarRegistroActividad(2, "Informe");
            $this->procesarRegistroActividad(3, "Proyecto de Investigación");
            $this->procesarRegistroActividad(3, "Informe Mensual 1");
            $this->procesarRegistroActividad(3, "Informe Mensual 2");
            $this->procesarRegistroActividad(3, "Informe Mensual 3");
            $this->procesarRegistroActividad(3, "Informe Mensual 4");
            $this->procesarRegistroActividad(3, "Informe Mensual 5");
            $this->procesarRegistroActividad(3, "Producto de Investigación");

            $this->procesarRegistroActividad(4, "Planificación");
            $this->procesarRegistroActividad(4, "Informe Mensual 1");
            $this->procesarRegistroActividad(4, "Informe Mensual 2");
            $this->procesarRegistroActividad(4, "Informe Mensual 3");
            $this->procesarRegistroActividad(4, "Informe Mensual 4");
            $this->procesarRegistroActividad(4, "Informe Mensual 5");
            $this->procesarRegistroActividad(4, "Producto de Investigación");

            $this->procesarRegistroActividad(5, "Proyecto de Vinculación");
            $this->procesarRegistroActividad(5, "Informe Mensual 1");
            $this->procesarRegistroActividad(5, "Informe Mensual 2");
            $this->procesarRegistroActividad(5, "Informe Mensual 3");
            $this->procesarRegistroActividad(5, "Informe Mensual 4");
            $this->procesarRegistroActividad(5, "Informe Mensual 5");
            $this->procesarRegistroActividad(5, "Producto de Vinculación");
            $this->procesarRegistroActividad(6, "Planificación");
            $this->procesarRegistroActividad(6, "Informe de Gestión");

        }

    }
    public function procesarRegistroCategoria($id, $nombre)
    {

        $categoria         = new Categoria;
        $categoria->id     = $id;
        $categoria->nombre = $nombre;
        $categoria->save();
    }
    public function procesarRegistroActividad($idCat, $nombre)
    {
        $actividad         = new Actividad;
        $actividad->idCat  = $idCat;
        $actividad->nombre = $nombre;
        $actividad->save();

    }

    public function registrarTipoParametro()
    {

        $verificarTipoParametro = Tipo_Parametro::all();
        if (!count($verificarTipoParametro)) {
            $this->procesarRegistroTipoParametro(1, "PORTAFOLIO");
            $this->procesarRegistroTipoParametro(2, "ASIGNATURA");
            $this->procesarRegistroTipoParametro(3, "PRODUCTO ACADÉMICO");
        }
    }

    public function procesarRegistroTipoParametro($id, $nombre)
    {
        $tipoParametro         = new Tipo_Parametro;
        $tipoParametro->id     = $id;
        $tipoParametro->nombre = $nombre;
        $tipoParametro->save();

    }

    public function registrarProductoAcademico()
    {

        $verificarProductoAca = Producto_Academico::all();
        if (!count($verificarProductoAca)) {
            $this->procesarRegistroProductoAcademico(1, "PRODUCTO ACADÉMICO 1");
            $this->procesarRegistroProductoAcademico(2, "PRODUCTO ACADÉMICO 2");
            $this->procesarRegistroProductoAcademico(3, "PRODUCTO ACADÉMICO 3");
            $this->procesarRegistroProductoAcademico(4, "PRODUCTO ACADÉMICO 4");
        }
    }

    public function procesarRegistroProductoAcademico($id, $nombre)
    {
        $productoAca         = new Producto_Academico;
        $productoAca->id     = $id;
        $productoAca->nombre = $nombre;
        $productoAca->save();
    }

}
