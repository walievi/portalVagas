@extends('layouts.app')
@extends('general')

@section('content')
<div class="container">
    <br>
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
                    <h4>{{ __('Formulário do candidato') }}: <span style="font-weight: normal;font-size: smaller;">{{ $candidatura->vaga->titulo }}</span></h4>
                    </div>
                </div>

                <form method="POST" action="" > 
                @csrf
                @method('PUT')
                    <div class="form-group mb-2">
                        <input id="nome" type="text" class="form-control" name="nome" value="{{ $candidatura->user->name }}" disabled>
                    </div>

                    <div class="form-group mb-2">
                        <a href="{{ route('curriculosVaga.showCurriculo', ['curriculo' => $candidatura->user->id]) }}" target="_blank" class="btn btn-dark">Visualizar currículo</a>

                    </div>

                    @foreach ($candidatura->getRespostas() as $resposta)
                        <div class="pergunta mb-3 mt-3">
                            <label class="mb-1"><b>{{ __($resposta->pergunta->pergunta) }}</b></label><br>    
                            <label class="mb-1">{{ __($resposta?->resposta) }}</label><br>
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

                <form method="POST" action="{{ route('feedback.store') }}" > 
                @csrf
                    <input type="hidden" name="vaga_id" value="{{ $candidatura->vaga->id }}">
                    <input type="hidden" name="user_id" value="{{ $candidatura->user->id }}">
                    <!--- usamos o input abaixo para enviar o candidatura_vaga_id para o store de feedback --->
                    <input type="hidden" name="candidatura_vaga_id" value="{{ $candidatura->id }}">

                    <div class="form-group mb-4">
                        <label for="feedback">{{ __('Registro de feedback') }}</label>
                        <textarea id="feedback" type="text" class="form-control" name="feedback" autocomplete="new-feedback" placeholder="Descreva aqui seu feedback sobre este currículo avaliado">{{ isset($candidatura->feedback) ? $candidatura->feedback->feedback_avaliacao : '' }}</textarea>
                    </div>

                    <div class="form-group mb-2">
                        <label for="status_processo">{{ __('Status da avaliação') }}</label>
                        
                        <select class="form-select form-select-md mb-3" aria-label="Large select example" id="status_processo" type="status" class="form-control @error('status_processo') is-invalid @enderror" name="status_processo" value="{{ old('status_processo') }}" required autocomplete="status_processo">
                            <option value="Aprovado" {{ $candidatura->feedback && $candidatura->feedback->status_processo === 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                            <option value="Rejeitado" {{ $candidatura->feedback && $candidatura->feedback->status_processo  === 'Rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                            <option value="Agendar entrevista" {{ $candidatura->feedback && $candidatura->feedback->status_processo  === 'Agendar entrevista' ? 'selected' : '' }}>Agendar entrevista</option>
                            <option value="Contratado" {{ $candidatura->feedback && $candidatura->feedback->status_processo  === 'Contratado' ? 'selected' : '' }}>Contratado</option>
                            <option value="Arquivado" {{ $candidatura->feedback && $candidatura->feedback->status_processo  === 'Arquivado' ? 'selected' : '' }}>Arquivado</option>
                            <option value="Em análise" {{ $candidatura->feedback && $candidatura->feedback->status_processo  === 'Em análise' ? 'selected' : '' }}>Em análise</option>
                        </select>

                        @error('status')
                            <span class="invalid-status_processo" role="alert">
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

                <form method="POST" action="{{ route('feedback.mail', ['vaga' => $candidatura->vaga->id, 'user' => $candidatura->user->id]) }}">
                @csrf
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
                    <h4>{{ __('Transferência de vaga') }}: </h4>
                    </div>
                </div>

                <form method="POST" action="{{ route('curriculosVaga.update') }}" > 
                @csrf
                <div class="form-group mb-2">
                    <label for="status_processo">{{ __('Selecione a vaga a qual deseja transferir este candidato:') }}</label>
                    <input type="hidden" name="user_id" value="{{ $candidatura->user->id }}">
                    <input type="hidden" name="transferencia_vaga_id" value="{{ $candidatura->vaga->id }}">
                    <input type="hidden" name="candidatura_vaga_id" value="{{ $candidatura->id }}">
                    
                    <select class="form-select form-select-md mb-3" aria-label="Large select example" id="vaga_id" type="status" class="form-control @error('vaga_id') is-invalid @enderror" name="vaga_id" value="{{ old('vaga_id') }}" required autocomplete="vaga_id">
                        @foreach ($listaVagas as $vaga)
                        <option value="{{ $vaga->id }}" name="vaga_id">{{ $vaga->titulo}}</option>
                        @endforeach 
                    </select>
                    
                    @error('status')
                        <span class="invalid-status_processo" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            
                    <div class="form-group mb-2 mt-5">
                        <center>
                            <button type="submit" class="btn btn-dark">
                                {{ __('Transferir') }}
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