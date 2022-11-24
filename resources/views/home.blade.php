@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <a href="{{ route('listaFuncionarios') }}" >Manejo de Funcionarios</a>
                <a href="{{ route('cuestionarioClima') }}" >Cuestionario de clima</a>
                <a href="{{ route('vistaEstudio') }}" >Estudio de clima organizacional</a>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bienvenido!') }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
