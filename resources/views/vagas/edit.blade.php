@extends('layouts.app')
@extends('general')
@section('content')


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
                            <h4>  {{ __('Editar vaga') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('vaga.update', $vaga->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="titulo">{{ __('Titulo') }}</label>
                            <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ $vaga->titulo }}" required autocomplete="titulo" autofocus>

                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>


                        <div class="form-group mb-2">
                            <label for="unidade">{{ __('Unidade') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="unidade" name="unidade" required autocomplete="unidade">
                                <option value="Unidade Pindorama" @if(old('unidade', $vaga->unidade) == 'Unidade Pindorama') selected @endif>Unidade Pindorama</option>
                                <option value="Unidade Oswaldo Cruz" @if(old('unidade', $vaga->unidade) == 'Unidade Oswaldo Cruz') selected @endif>Unidade Oswaldo Cruz</option>
                                <option value="Unidade Fundação Evangélica" @if(old('unidade', $vaga->unidade) == 'Unidade Fundação Evangélica') selected @endif>Unidade Fundação Evangélica</option>
                                <option value="Todos" @if(old('unidade', $vaga->unidade) == 'Todos') selected @endif>Todos</option>

                            </select>

                            @error('unidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>


                        <div class="form-group mb-2">
                            <label for="status">{{ __('Status') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="status" name="status" required autocomplete="status">
                                <option value="Aberta" @if(old('status', $vaga->status) == 'Aberta') selected @endif>Aberta</option>
                                <option value="Fechada" @if(old('status', $vaga->status) == 'Fechada') selected @endif>Fechada</option>
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('vaga.index')}}" class="btn btn-secondary">
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

@endsection
