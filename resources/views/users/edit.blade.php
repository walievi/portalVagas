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
                                <h4>{{ __('Editar usuário') }}</h4>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('edit', ['id' => $user->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-2">
                                <label for="name">{{ __('Nome') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus value="{{ $user->nome }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-group mb-2">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="{{ $user->role }}" id="role" for="role" name="role">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Administrador
                                </label>
                            </div>

                            <div class="form-group mb-2">
                                <center>
                                    <a type="button" href="{{route('users')}}" class="btn btn-secondary">
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
