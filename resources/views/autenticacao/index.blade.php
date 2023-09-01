@extends('general')

@section('page')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-text text-center fs-2 mt-4">{{ __('Portal de vagas') }}</div>

                <div class="card-body p-5 ">
                    <form >
                        @csrf

                        <div class="form-group mb-2">
                            <label for="email">{{ __('Login') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Recuperar senha') }}
                            </a>
                        @endif

                        <center><button type="submit" class="mt-3 btn btn-warning">{{ __('Acessar') }}</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection