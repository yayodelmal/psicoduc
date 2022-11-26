@extends('layouts.login')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Confirme su contraseña antes de continuar</h1>
    </div>

    <form class="user" method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="row mb-3">
            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label> --}}

            <div class="col-md-12">
                <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-12 offset-md-12">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Confirmar Contraseña') }}
                </button>

                <hr>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Recuperar Contraseña') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
