@extends('principal')
@section('title','Inicio')
@section('content')

@if (Auth::user()->idRol==1) 
@include('Rol/docente')
@endif

@if (Auth::user()->idRol==2) 
@include('Rol/coordinador')
@endif

@if (Auth::user()->idRol==3) 

@include('Rol/decano')
@endif




@endsection
