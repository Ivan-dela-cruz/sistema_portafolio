@extends('layouts.app')

@section('content')
<div class="container">

<div class="row">
    
<div class="col-md-2"></div>
<div class="col-md-8 text-center">
    
@if(Session::has('mensaje'))

<div class="alert alert-warning">
 <b> <strong>{{ Session::get('mensaje') }}</strong></b> 
</div>
@endif
</div>


<div class="col-md-2"></div>

</div>



    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cédula: </label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" name="cedula" value="{{ old('cedula') }}"  autofocus>
                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





      <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                            <label for="apellido" class="col-md-4 control-label">Apellidos: </label>

                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" autofocus>

                                @if ($errors->has('apellido'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


      <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombres: </label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"  autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Institucional:</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
