@extends('layouts.login')

@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Resetear contraseña</h1>
</div>


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="user" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Enviar link de reseteo de contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
@endsection
