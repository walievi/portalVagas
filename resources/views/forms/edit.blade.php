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
                                <h4>  {{ __('CadasEditartrar Formulário') }}</h4>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('editForm', ['id' => $form->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-2">
                                <label for="pergunta">{{ __('pergunta') }}</label>
                                <input id="pergunta" type="text" class="form-control @error('pergunta') is-invalid @enderror" name="pergunta" value="{{ $form->pergunta }}" required autocomplete="pergunta" autofocus>

                                @error('pergunta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-group mb-2">
                                <label for="vaga_id">{{ __('ID da vaga') }}</label>
                                <input id="vaga_id" type="text" class="form-control @error('vaga_id') is-invalid @enderror" name="vaga_id" value="{{ $form->vaga_id }}" required autocomplete="vaga_id" autofocus>

                                @error('vaga_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-group mb-2">
                                <center>
                                    <a type="button" href="{{route('forms')}}" class="btn btn-secondary">
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
