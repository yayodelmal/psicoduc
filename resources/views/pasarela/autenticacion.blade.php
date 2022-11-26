@extends('layouts.login')

@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Autenticación de usuario para aplicación de instrumentos</h1>
</div>

@if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@elseif (session('statuserror'))
    <div class="alert alert-danger" role="alert">
        {{ session('statuserror') }}
    </div>
@endif

<form class="user" method="POST" action="{{ route('verificarFuncionarioMoodle') }}" accept-charset="UTF-8" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-user"
            id="email" name="email" aria-describedby="emailHelp"
            placeholder="Ingrese su correo...">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user"
            id="password" name="password" placeholder="Contraseña">
    </div>

    {{-- <a  class="btn btn-primary btn-user btn-block">
        Ingresar
    </a> --}}



    <button type="submit" class="btn btn-primary btn-user btn-block">
        Ingresar
    </button>




</form>
<hr>
<div class="text-center">
    <a class="small" href="#">¿Olvidaste tu contraseña?</a>
</div>
@endsection
