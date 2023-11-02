@extends('layouts.app')
@extends('general')

@section('content')
<div class="container">
@if(session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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
                    <h4>{{ __('Formulário do candidato') }}: <span style="font-weight: normal;font-size: smaller;">{{ $vaga->titulo }}</span></h4>
                    </div>
                </div>

                <form method="POST" action="" > 
                @csrf
                @method('PUT')
                    <div class="form-group mb-2">
                        <label for="nome">{{ __('Nome') }}</label>
                        <input id="nome" type="text" class="form-control" name="nome" value="{{ $user->name }}" disabled>
                        <input type="hidden" name="vaga_id" value="{{ $vaga->id }}">
                    </div>
                
                    @foreach ($perguntas as $pergunta)
                        <div class="pergunta mb-3 mt-3">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][]" value="{{ $pergunta->id }}">
                            <label class="mb-1"><b>{{ __($pergunta->pergunta) }}</b></label><br>
                            @foreach ($curriculos as $curriculo)
                                @if ($curriculo->pergunta_id == $pergunta->id)
                                    <input type="hidden" name="curriculos[{{ $curriculo->id }}][]" value="{{ $curriculo->id }}">
                                    <label class="mb-1">{{ __($curriculo->resposta) }}</label><br>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 ">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-9">
                    <h4>{{ __('Feedback') }}: </h4>
                    </div>
                </div>

                <form method="POST" action="" > 
                @csrf
                @method('PUT')
                    <div class="form-group mb-4">
                        <label for="feedback">{{ __('Registro de feedback') }}</label>
                        <textarea id="feedback" type="text" class="form-control" name="feedback" autocomplete="new-feedback" placeholder="Descreva aqui seu feedback sobre este currículo avaliado">{{ isset($user->dadosPessoais) ? $user->dadosPessoais->habilidades : '' }}</textarea>
                    </div>

                    <div class="form-group mb-2">
                        <label for="status">{{ __('Status da avaliação') }}</label>
                        
                        <select class="form-select form-select-md mb-3" aria-label="Large select example" id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status">
                            <option value="Aberta" selected>Aprovado</option>
                            <option value="Fechada">Rejeitado</option>
                            <option value="Fechada">Agendar entrevista</option>
                            <option value="Fechada">Contratado</option>
                            <option value="Fechada">Arquivado</option>
                        </select>

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group mb-2 mt-5">
                        <center>
                            <button type="submit" class="btn btn-dark">
                                {{ __('Salvar') }}
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 ">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-9">
                    <h4>{{ __('Retornar para candidato') }}: </h4>
                    </div>
                </div>

                <form method="POST" action="" > 
                @csrf
                @method('PUT')
                    <div class="form-group mb-4">
                        <label for="retorno">{{ __('Retorno para o candidato via e-mail') }}</label>
                        <textarea id="retorno" type="text" class="form-control" name="retorno" autocomplete="new-retorno" placeholder="Escreva aqui seu retorno para o candidato do currículo avaliado"></textarea>
                    </div>

            
                    <div class="form-group mb-2 mt-5">
                        <center>
                            <button type="submit" class="btn btn-dark">
                                {{ __('Enviar retorno') }}
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