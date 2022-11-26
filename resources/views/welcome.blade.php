@extends('layouts.app')
@section('content')
<a href="{{ route('listaFuncionarios') }}" >Manejo de Funcionarios</a>
<a href="{{ route('cuestionarioClima') }}" >Cuestionario de clima</a>
<a href="{{ route('vistaEstudio') }}" >Estudio de clima organizacional</a>
@endsection
