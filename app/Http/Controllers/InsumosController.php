<?php

namespace App\Http\Controllers;

use App\Insumo;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class InsumosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::all();
        $insumos = Insumo::orderBy('created_at', 'ASC')->paginate(8);

        return view('Coordinador.InsumosIndex', compact('insumos', 'periodos'));

    }

    public function insumosDocentes()
    {
        $insumos = Insumo::all();

        return view('Docente.InsumosIndexDocente', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = Periodo::all();

        $hoy = Carbon::now();
        $fechaHoy = Carbon::parse($hoy)->format('Y-m-d');

        $insumos = Insumo::whereDate('created_at', $fechaHoy)->get();

        if (count($periodos) >= 1) {
            return view('Coordinador.InsumosCreate', compact('periodos', 'insumos'));
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "No existe registrado ningun Período Académico .");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|string',
            'id_periodo' => 'required|integer',
            'url_doc' => 'mimes:docx,doc,txt,xps,xml',
            'url_xls' => 'mimes:xlsx,xls,csv,xla',
            'url_pdf' => 'mimes:pdf',
            'descripcion' => 'string'

        ]);

        //RUTAS POR DEFECTO QUE SERAN MODIFICADAS EN EL CASO QUE SE EXISTA UN ARCHIVO CARGADO
        $rutaDoc = '';
        $rutaXls = '';
        $rutaPdf = '';

        //CREA UN NUEVO INSUMO
        $insumo = new Insumo();
        $insumo->titulo = $request->titulo;
        $insumo->id_periodo = $request->id_periodo;
        $insumo->descripcion = $request->descripcion;
        $insumo->save();

        //OBTENEMOS EL NOMBRE QUE LLEVARA LOS ARCHIVOS  EN BASE AL TITULO DEL INSUMO PERO SIN ESPACIOS
        $nombreArchivos = Str::slug($request->titulo, '-');

        //VALIDAMOS QUE LOS ARCHIVOS ESTEN CARGADOS
        if ($request->file('url_doc')) {
            $doc = $request->file('url_doc');
            //OBTENEMOS LA EXTENSION DEL ARCHIVO
            $extension_doc = $doc->getClientOriginalExtension();
            //CREAMOS UNA CADENA QUE REPRESENTARA EL NOMBRE DEL ARCHIVO
            $nombre_doc = $nombreArchivos . '.' . $extension_doc;
            //GUARDAMOS LOS ARCHIVOS EN LA RUTA DEL STORAGE
            $r1 = Storage::disk('insumosdoc')->put(utf8_decode($nombre_doc), \File::get($doc));
            //GENERAMOS LA RUTA DEL ARCHIVO
            $rutaDoc = "storage/insumosDocentes/doc/" . $nombre_doc;
        }
        if ($request->file('url_pdf')) {
            $pdf = $request->file('url_pdf');
            $extension_pdf = $pdf->getClientOriginalExtension();
            $nombre_pdf = $nombreArchivos . '.' . $extension_pdf;
            $r2 = Storage::disk('insumospdf')->put(utf8_decode($nombre_pdf), \File::get($pdf));
            $rutaPdf = "storage/insumosDocentes/pdf/" . $nombre_pdf;
        }

        if ($request->file('url_xls')) {
            $xls = $request->file('url_xls');
            $extension_xls = $xls->getClientOriginalExtension();
            $nombre_xls = $nombreArchivos . '.' . $extension_xls;
            $r3 = Storage::disk('insumosxls')->put(utf8_decode($nombre_xls), \File::get($xls));
            $rutaXls = "storage/insumosDocentes/xls/" . $nombre_xls;
        }

        //ACTUALIZAMOS LAS RUTAS DE LOS ARCHIVOS ADJUNTADOS
        $insumo->url_doc = $rutaDoc;
        $insumo->url_xls = $rutaXls;
        $insumo->url_pdf = $rutaPdf;
        $insumo->save();

        $hoy = Carbon::now();

        $insumos = Insumo::whereDate('created_at', $hoy)->get();

        return redirect()->route('crear-insumos');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //eliminar pdf
    public function eliminarPdfInsumo($idDocu)
    {
        $insumo = Insumo::find($idDocu);
        $url_pdf = $insumo->url_pdf;
        $rs = File::delete($url_pdf);

        if($rs){
            return $insumo;
        }else{
            return 'no funciona';
        }
    }


    //Descargar insumos pdf
    public function descargarPdfInsumo($idDocu)
    {
        $insumo = Insumo::find($idDocu);
        $rutaPdf = $insumo->url_pdf;
        return response()->download($rutaPdf, $insumo->titulo . ".pdf");
    }

    //Descargar insumos tipo word
    public function descargarDocInsumo($idDocu)
    {
        $insumo = Insumo::find($idDocu);
        $rutaPdf = $insumo->url_doc;
        return response()->download($rutaPdf, $insumo->titulo . ".doc");
    }

    //Descargar insumos tipo excel
    public function descargarXlsInsumo($idDocu)
    {
        $insumo = Insumo::find($idDocu);
        $rutaPdf = $insumo->url_xls;
        return response()->download($rutaPdf, $insumo->titulo . ".xlsx");
    }
}
