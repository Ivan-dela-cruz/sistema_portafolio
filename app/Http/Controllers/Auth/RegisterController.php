<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rol;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {

        $rols = Rol::all();
//dd($rol);

        if (!count($rols)) {
            $rols = new Rol;

            $rols->id     = 1;
            $rols->nombre = "DOCENTE";
            $rols->save();
            $rols = new Rol;

            $rols->id     = 2;
            $rols->nombre = "COORDINADOR";
            $rols->save();

            $rols = new Rol;

            $rols->id     = 3;
            $rols->nombre = "DECANO";
            $rols->save();

        }

        return Validator::make($data, [
            'cedula'   => 'required|max:10|unique:users|min:10|regex:/^[0-9]+$/',
            'apellido' => 'required|max:100|min:3',
            'nombre'   => 'required|max:100|min:3',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'idRol'           => "1",
            'cedula'          => $data['cedula'],
            'apellido'        => $data['apellido'],
            'nombre'          => $data['nombre'],
            'lugarNacimiento' => "",
            'fechaNacimiento' => date('Y-m-d'),
            'celular'         => null,
            'telefono'        => null,
            'direccion'       => "",
            'sexo'            => 0,
            'foto'            => "",
            'fechaIngresoUtc' => "",
            'nacionalidad'    => 0,
            'cargaFamiliar'   => 0,
            'estadoCivil'     => 0,
            'facultad'        => 0,
            'email'           => $data['email'],
            'password'        => bcrypt($data['password']),

        ]);
    }
}
