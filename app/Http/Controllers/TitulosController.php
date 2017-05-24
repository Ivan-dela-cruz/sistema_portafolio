<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Nivel;
use App\Titulo;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TitulosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function estudiosDocente()
    {
        $docente = \Auth::user();

        $nivels = Nivel::all();
//$cont=count($docente);

        if (!count($nivels)) {
            $nivels         = new Nivel;
            $nivels->id     = 1;
            $nivels->nombre = "TERCER";
            $nivels->save();

            $nivels         = new Nivel;
            $nivels->id     = 2;
            $nivels->nombre = "CUARTO";
            $nivels->save();

        }

        $nivel = Nivel::all();
//El metodo titulos se encuentra en el modelo User
        $titulo = $docente->titulos();
//dd($titulo);
        return view("Docente.estudiosDocente")->with("docente", $docente)->with("nivel", $nivel)->with("titulo", $titulo);
    }

    public function actualizarEstudiosDocente()
    {

        $docenteActual = \Auth::user()->id;

        $nivel = Nivel::all();

        $docente = \Auth::user();
        $titulo  = $docente->titulos();

        return view("Docente.actualizarEstudiosDocente")->with("docente", $docente)->with("nivel", $nivel)->with("titulo", $titulo);

    }

    public function agregarTitulo(Request $request)
    {

        $reglas = ['titulo' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'fecha'             => 'required',
            'codigoSnt'         => 'required',

        ];
        $mensajes = [
            'titulo.required'    => 'Título es obligatorio.',
            'titulo.regex'       => 'Título solo debe contener letras.',
            'codigoSnt.required' => 'Código de registro Conesup o Senescyt es obligatorio.',
            'fecha.required'     => 'Fecha de registro título es obligatorio.',

        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return new JsonResponse($validator->errors(), 422);
        }

        $docenteActual          = \Auth::user()->id;
        $titulo                 = new titulo;
        $titulo->idDoc          = $docenteActual;
        $titulo->idNivel        = $request->input("nivel");
        $titulo->nombre         = $request->input("titulo");
        $titulo->fechaRegistro  = $request->input("fecha");
        $titulo->codigoRegistro = $request->input("codigoSnt");
        $rs                     = $titulo->save();
        if ($rs) {
            return view("mensajes.msj_correcto")->with("msj", "Título registrado correctamente. ");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Huvo un error intente nuevamente.");
        }

    }

    public function eliminarTitulo($id)
    {
        $titulo = Titulo::find($id);
        $rs     = $titulo->delete();
        if ($rs) {
            return view("mensajes.msj_rechazado")->with("msj", "Título borrado Correctamente ");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Huvo un error vuelva a intentar ");

        }

    }

}
