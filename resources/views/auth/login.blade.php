@extends('layouts.login')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Autenticación de usuario</h1>
    </div>

    <form class="user" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row mb-3">
            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label> --}}

            <div class="col-md-12">
                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

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

        <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Recordarme') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-12 offset-md-12">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Ingresar') }}
                </button>

                <hr>

                @if (Route::has('password.request'))
                    <a class="btn btn-block small" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
