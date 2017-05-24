<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\User;
//El disco que se va a ocupar
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

//Para la validadcion de la imagen
//use App\Http\Controllers\Controller;
use Storage;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    //public function consultarDocente($id){
    //$usuario=User::find($id);
    //$contador=count($usuario);

//    if ($contador)
    //    return view("docente.form_editar_usuario")->with("usuario",$usuario);
    //    else
    //    return view("mensajes.msj_rechazado")->with("msj","El docente fue eliminado..");
    //    }

    public function editarPerfilDocente()
    {

        $idUsuarioActual = \Auth::user();
        $contador        = count($idUsuarioActual);

        if ($contador) {
            return view("Docente.editarPerfilDocente")->with("usuario", $idUsuarioActual);
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "El docente fue eliminado..");
        }

    }

    public function calculaedad($fechanacimiento)
    {
        list($ano, $mes, $dia) = explode("-", $fechanacimiento);
        $ano_diferencia        = date("Y") - $ano;
        $mes_diferencia        = date("m") - $mes;
        $dia_diferencia        = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0) {
            $ano_diferencia--;
        }

        return $ano_diferencia;
    }

    public function editarDocente(Request $request)
    {
        $edad = $this->calculaedad($request->input('fecha'));

        if ($edad > 20 && $edad <= 70) {

        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Fecha de nacimiento no valida su edad actual es : " . $edad . " años.");

        }

        //  $reglas = ['nombres' => 'required',
        //            'apellidos'          => 'required',
        //          'telefono'           => 'required|numeric',
        //        'password'           => 'required|min:8',
        //      'email'              => 'required|email|unique:users'];

        //     $mensajes = ['nombres.required' => 'es obligatorio',
        //     'apellidos.required'            => 'el apellido es obligatorio',
        //   'telefono.numeric'              => 'el telefono debe contener solo numeros',
        // 'password.min'                  => 'El password debe tener al menos 8 caracteres',
        //'email.unique'                  => 'El email ya se encuentra registrado en la base de datos'];

        $reglas = ['nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido'          => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'celular'           => 'required|digits:10|numeric',
            'telefono'          => 'digits:9|numeric',
            'lugar'             => 'required',
            'fecha'             => 'required',
            'direccionDomi'     => 'required',

            'cargasFamiliar'    => 'required',
            'sexo'              => 'required',
            'nacionalidad'      => 'required',
            'estado'            => 'required',

        ];
        $mensajes = [
            'nombre.required'         => 'Nombre es obligatorio.',
            'nombre.regex'            => 'Nombre solo debe contener letras.',

            'apellido.required'       => 'Apellido es obligatorio.',
            'apellido.regex'          => 'Apellido solo debe contener letras.',

            'celular.required'        => 'Número celular es obligatorio.',
            'celular.digits'          => 'Número celular debe tener 10 dígitos.',
            'celular.numeric'         => 'Número celular debe ser numérico.',

            'telefono.digits'         => 'Número teléfono  debe tener 9 dígitos.',
            'telefono.numeric'        => 'Número teléfono debe ser numérico.',

            'lugar.required'          => 'Lugar de nacimiento es obligatorio.',

            'fecha.required'          => 'Fecha de nacimiento es obligatorio.',
            'direccionDomi.required'  => 'Dirección domiciliaria  es obligatorio.',

            'cargasFamiliar.required' => ' Seleccione N° de cargas familiar  es obligatorio.',

            'sexo.required'           => 'Seleccione género es obligatorio.',
            'nacionalidad.required'   => 'Seleccione nacionalidad es obligatorio.',

            'estado.required'         => ' Seleccione estado civil es obligatorio.',

        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return new JsonResponse($validator->errors(), 422);
        }

        //    $celular = $request->input('celular');
        //   $input   = array('celular' => $celular);
        //  $reglas  = array('celular' => 'required|digits:10|numeric');

        //  $validacion = Validator::make($input, $reglas);
        //  if ($validacion->fails()) {
        // return view("mensajes.msj_rechazado")->with("msj","El archivo no es una imagen valida"):
        //    return new JsonResponse($validacion->errors(), 422);
        //}

        $dato                     = $request->all();
        $idDoc                    = $dato['idDocente'];
        $usuario                  = User::find($idDoc);
        $usuario->nombre          = $dato["nombre"];
        $usuario->apellido        = $dato["apellido"];
        $usuario->cedula          = $dato["cedula"];
        $usuario->celular         = $dato["celular"];
        $usuario->telefono        = $dato["telefono"];
        $usuario->lugarNacimiento = $dato["lugar"];
        $usuario->fechaNacimiento = $dato["fecha"];

        $usuario->direccion    = $dato["direccionDomi"];
        $usuario->sexo         = $dato["sexo"];
        $usuario->nacionalidad = $dato["nacionalidad"];

        $usuario->estadoCivil   = $dato["estado"];
        $usuario->cargaFamiliar = $dato["cargasFamiliar"];

        $rs = $usuario->save();
        if ($rs) {
            return view("mensajes.msj_correcto")->with("msj", "Datos actualizados correctamente..");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Huvo un error vuelva a intentarlo..");
        }

    }

    public function editarHistorial(Request $request)
    {
        $dato                     = $request->all();
        $idDoc                    = $dato['idDoc'];
        $usuario                  = User::find($idDoc);
        $usuario->fechaIngresoUtc = $dato["ingresoUtc"];
        $usuario->facultad        = $dato["facultad"];
        $rs                       = $usuario->save();
        if ($rs) {
            return view("mensajes.msj_correcto")->with("msj", "Información actualizada correctamente..");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error intente nuevamente..");
        }

    }

    public function subirImagen(Request $request)
    {
        $id      = $request->input('id_usuario_foto');
        $archivo = $request->file('archivo');
        //No comprobado
        //'avatar' => 'dimensions:min_width=100,min_height=200'
        $input      = array('imagen' => $archivo);
        $reglas     = array('imagen' => 'required|image|mimes:jpeg,jpg|max:100|min:10');
        $validacion = Validator::make($input, $reglas);
        if ($validacion->fails()) {
            // return view("mensajes.msj_rechazado")->with("msj","El archivo no es una imagen valida"):
            return view("mensajes.mensaje_error")->withErrors($validacion->errors());
        }

        $nombre_original = $archivo->getClientOriginalName();
        $extension       = $archivo->getClientOriginalExtension();

        $nuevo_nombre = "fotoUser-" . $id . "." . $extension;
        //Nombre del disco creado en filesSytem
        $r1             = Storage::disk('fotografia')->put($nuevo_nombre, \File::get($archivo));
        $rutadelaimagen = "storage/fotografia/" . $nuevo_nombre;

        if ($r1) {
            // dd($archivo);
            $usuario       = User::find($id);
            $usuario->foto = $rutadelaimagen;
            $r2            = $usuario->save();
            return view("mensajes.msj_correcto")->with("msj", "Fotografía actualizada correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", " Error no se cargo la imagen");
        }

    }

    public function cambiarClave(Request $request)
    {

        //crea un nuevo usuario en el sistema

        $reglas = ['clave' => 'required|min:6'];

        $mensajes = ['clave.min' => 'El password debe tener al menos 6 caracteres'];

        $validator = Validator::make($request->all(), $reglas, $mensajes);

        if ($validator->fails()) {
            return view("mensajes.mensaje_error")->withErrors($validator->errors());
        }

        $id                = $request->input("idUsu");
        $email             = $request->input("email");
        $clave             = $request->input("clave");
        $usuario           = User::find($id);
        $usuario->email    = $email;
        $usuario->password = bcrypt($clave);
        $rs                = $usuario->save();
        if ($rs) {
            return view("mensajes.msj_correcto")->with("msj", "Contraseña actualizada correctamente.");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error al actualizar la contraseña ");
        }

    }

    public function listaDocente()
    {

        $periodo = DB::table('periodo')->orderBy('id', 'desc')->get();
        $carrera = Carrera::all();

        return view("Coordinador.listaDocente")->with("carrera", $carrera)->with('periodos', $periodo);
    }

    public function buscarListadoDocente($idPer, $idCar, $dato = "")
    {

///dd($idPer,$idCar,$dato);
        $docentes = DB::table("users")->join('portafolio', 'users.id', '=', 'portafolio.idDoc')->join('carrera', 'carrera.id', '=', 'portafolio.idCar')->join('periodo', 'periodo.id', '=', 'portafolio.idPer')->where('periodo.id', '=', $idPer)->where('carrera.id', '=', $idCar)->where(function ($q) use ($dato) {
            $q->where('users.cedula', 'like', '%' . $dato . '%')->orWhere('users.nombre', 'like', '%' . $dato . '%')->orWhere('users.apellido', 'like', '%' . $dato . '%')->orwhere(DB::raw('concat(users.nombre," ",users.apellido)'), 'LIKE', '%' . $dato . '%')->orwhere(DB::raw('concat(users.apellido," ", users.nombre)'), 'LIKE', '%' . $dato . '%');
        })->select('users.*', 'portafolio.id as idPor')->orderBy('users.apellido', 'asc')->Paginate(12);

//select * from users where pais = $pais  and (nombres like %$dato% or apellidos like %$dato%  or email like  %$dato% )
        //  $resultado= $query->where("pais","=",$pais)
        //                    ->Where(function($q) use ($pais,$dato)  {
        //                    $q->where('nombres','like','%'.$dato.'%')
        //                    ->orWhere('apellidos','like', '%'.$dato.'%')
        //                  ->orWhere('email','like', '%'.$dato.'%');
        //             });

        return view("Coordinador.buscarListadoDocente")->with("docentes", $docentes);

    }

}
