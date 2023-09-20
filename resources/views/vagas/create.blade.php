@extends('layouts.app')
@extends('general')
@section('content')

<div class="background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <h4>  {{ __('Cadastrar vaga') }}</h4>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('create') }}">
                            @csrf

                            <div class="form-group mb-2">
                                <label for="titulo">{{ __('Titulo') }}</label>
                                <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required autocomplete="titulo" autofocus>

                                @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-group mb-2">
                                <label for="status">{{ __('Email') }}</label>
                                <input id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status">

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-group mb-2">
                                <center>
                                    <a type="button" href="{{route('vagas')}}" class="btn btn-secondary">
                                        {{ __('Voltar') }}
                                    </a>
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Salvar') }}
                                    </button>
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
