@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <b>Nuevo Funcionario</b>
                            </div>
                            <div class="col-2">
                                <a  href="{{ route('listaFuncionarios') }}" 
                                    class="btn btn-info"
                                    role="button">Regresar
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- formulario --}}
                    <div class="card-body">

                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @elseif (session('statuserror'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('statuserror') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('guardarNuevoFuncionario') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>
                                    <div class="col-md-5">
                                        <input id="email" name="email" type="email" class="form-control{{ $errors->has("email") ? ' is-invalid' : ''}}" 
                                        value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                    <div class="col-md-5">
                                        <input id="nombre" name="nombre" type="text" class="form-control{{ $errors->has("nombre") ? ' is-invalid' : ''}}" 
                                        value="{{ old('nombre') }}" required>

                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellidos" class="col-md-4 col-form-label text-md-right">Apellidos</label>
                                    <div class="col-md-5">
                                        <input id="apellidos" name="apellidos" type="text" class="form-control{{ $errors->has("apellidos") ? ' is-invalid' : ''}}" 
                                        value="{{ old('apellidos') }}" required>

                                        @if ($errors->has('apellidos'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('apellidos') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="nombre_usuario" class="col-md-4 col-form-label text-md-right">Nombre de usuario</label>
                                    <div class="col-md-5">
                                        <input id="nombre_usuario" name="nombre_usuario" type="text" class="form-control{{ $errors->has("nombre_usuario") ? ' is-invalid' : ''}}" 
                                        value="{{ old('nombre_usuario') }}" required>

                                        @if ($errors->has('nombre_usuario'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nombre_usuario') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="contrasenia" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                    <div class="col-md-5">
                                        <input id="contrasenia" name="contrasenia" type="text" class="form-control{{ $errors->has("apellidos") ? ' is-invalid' : ''}}" 
                                        value="{{ old('contrasenia') }}" required>

                                        @if ($errors->has('contrasenia'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('contrasenia') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="unidad" class="col-md-4 col-form-label text-md-right">Unidad</label>
                                    <div class="col-md-5">
                                        <select class="form-control{{ $errors->has('unidad') ? ' is-invalid' : '' }}" name="unidad" id="unidad" data-live-search="true">
                                            <option value="-1" selected>Seleccionar... </option>
                                            @foreach($listadeunidades as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['fullname'] }} | {{ $item['shortname']}}- ({{ $item['visible'] == 1 ? 'A' : 'I'}})</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('unidad'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('unidad') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <br/>
                            <div class="form-group row mb-0">

                                <div class="col-6 text-center">
                                    <button type="submit" class="btn btn-success" id="btnEnviar">Agregar Funcionario</button>
                                </div>
                                
                                <div class="col-6 text-center">
                                    <a href="{{ route('listaFuncionarios') }}" class="btn btn-danger" role="button">Regresar</a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
@endsection
