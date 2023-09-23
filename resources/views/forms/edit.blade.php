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
                                <h4>  {{ __('Editar Formulário') }}</h4>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('editForm', ['id' => $form->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-2">
                                <label for="pergunta">{{ __('Nome') }}</label>
                                <input id="pergunta" type="text" class="form-control @error('pergunta') is-invalid @enderror" name="pergunta" value="{{ $form->nome_formulario }}" required autocomplete="pergunta" autofocus>

                                @error('pergunta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="form-group mb-2">
                                <label for="vaga_id">{{ __('Vaga') }}</label>
                                <select class="form-select form-select-md mb-3" aria-label="Large select example" id="vaga" name="vaga" required autocomplete="vaga">
                                    @foreach($vagas as $vaga)
                                    <option value="{{ $vaga->id }}">{{ $vaga->titulo }}</option>
                                    @endforeach                         
                                </select>

                                @error('vaga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $vaga }}</strong>
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
