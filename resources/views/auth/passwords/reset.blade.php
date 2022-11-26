@extends('layouts.login')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Reiniciar contraseña</h1>
    </div>
    <form class="user" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="row mb-3">
            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

            <div class="col-md-12">
                <input id="email" type="email"
                    class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

            <div class="col-md-12">
                <input id="password" type="password"
                    class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password" placeholder="Contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}

            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control form-control-user"
                    name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-12 offset-md-12">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Reiniciar Contraseña') }}
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
