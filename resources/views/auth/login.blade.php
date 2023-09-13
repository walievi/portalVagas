@extends('layouts.app')
@extends('general')

@section('content')
<div class="background">
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-text text-center fs-2 mt-4">{{ __('Login') }}</div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="email">{{ __('Email') }}</label>                           
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           
                        </div>

                        <div class="form-group">
                            <label for="password" >{{ __('Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-md-6">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label " for="remember">
                                        {{ __('Permanecer logado') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Recuperar senha') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <center>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Acessar') }}
                                    </button>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
