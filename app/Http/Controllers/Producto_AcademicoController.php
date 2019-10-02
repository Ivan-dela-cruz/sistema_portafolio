<?php

namespace App\Http\Controllers;

use App\Producto_Academico;
use http\Env\Response;
use Illuminate\Http\Request;

class Producto_AcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto_Academico::all();

        return view('Coordinador.ProductosAcademicos', compact('productos'));
    }

    public function refreshTable()
    {
        $productos = Producto_Academico::all();

        return view('Coordinador.tablaProductos', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto_Academico();

        $producto->nombre = $request->nombre;
        $producto->save();

        return response()->json([
            'mensaje' => 'Producto académico agregado exitosamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $nombre = $request->nombre;
        $producto = Producto_Academico::find($request->id);
        $producto->nombre = $nombre;
        $producto->save();
        return response()->json([
            'mensaje' => 'Producto académico actualizado exitosamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $producto = Producto_Academico::find($request->id);
        $producto->delete();
        return response()->json([
            'mensaje'=>'Registro eliminado satisfactoriamente '
        ]);
    }
}
