@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('js/crearIntervencion.js') }}"></script>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <b>Nueva Intervención</b>
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

                        <form method="POST" action="{{ route('registrarIntervencion') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf

                            
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


                            <div class="form-group row">
                                <label for="periodo" class="col-md-4 col-form-label text-md-right">Periodo</label>
                                    <div class="col-md-5">
                                        <select class="form-control{{ $errors->has('mes') ? ' is-invalid' : '' }}" name="mes" id="mes" data-live-search="true">
                                            <option value="-1" selected>Seleccione un mes... </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control{{ $errors->has('anio') ? ' is-invalid' : '' }}" name="anio" id="anio" data-live-search="true">
                                            <option value="2022" selected>2022</option>
                                        </select>
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="instrumento" class="col-md-4 col-form-label text-md-right">Instrumento</label>
                                <div class="col-md-5">
                                    <select class="form-control{{ $errors->has('instrumento') ? ' is-invalid' : '' }}" name="instrumento" id="instrumento" data-live-search="true">
                                        <option value="1" selected>Cuestionario de Clima</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jefaturadirecta" class="col-md-4 col-form-label text-md-right">Jefatura directa</label>
                                    <div class="col-md-5">
                                        <input id="jefaturadirecta" name="jefaturadirecta" type="text" class="form-control{{ $errors->has("jefaturadirecta") ? ' is-invalid' : ''}}" 
                                        value="{{ old('jefaturadirecta') }}" required>

                                        @if ($errors->has('jefaturadirecta'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('jefaturadirecta') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="jefatura" class="col-md-4 col-form-label text-md-right">Jefatura</label>
                                    <div class="col-md-5">
                                        <input id="jefatura" name="jefatura" type="text" class="form-control{{ $errors->has("jefatura") ? ' is-invalid' : ''}}" 
                                        value="{{ old('jefatura') }}" required>

                                        @if ($errors->has('jefatura'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('jefatura') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                            </div>

                            <br/>
                            <div class="form-group row mb-0">

                                <div class="col-6 text-center">
                                    <button type="submit" class="btn btn-success" id="btnEnviar">Crear Intervención</button>
                                </div>
                                
                                <div class="col-6 text-center">
                                    <a href="{{ route('listaIntervenciones') }}" class="btn btn-danger" role="button">Regresar</a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection