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

                <form method="POST" action="{{ route('feedback.store') }}" > 
                @csrf
                    <input type="hidden" name="vaga_id" value="{{ $vaga->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group mb-4">
                        <label for="feedback">{{ __('Registro de feedback') }}</label>
                        <textarea id="feedback" type="text" class="form-control" name="feedback" autocomplete="new-feedback" placeholder="Descreva aqui seu feedback sobre este currículo avaliado">{{ isset($feedback) ? $feedback->feedback_avaliacao : '' }}</textarea>
                    </div>

                    <div class="form-group mb-2">
                        <label for="status_processo">{{ __('Status da avaliação') }}</label>
                        
                        <select class="form-select form-select-md mb-3" aria-label="Large select example" id="status_processo" type="status" class="form-control @error('status_processo') is-invalid @enderror" name="status_processo" value="{{ old('status_processo') }}" required autocomplete="status_processo">
                            <option value="Aprovado" {{ $feedback && $feedback->status_processo === 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                            <option value="Rejeitado" {{ $feedback && $feedback->status_processo === 'Rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                            <option value="Agendar entrevista" {{ $feedback && $feedback->status_processo === 'Agendar entrevista' ? 'selected' : '' }}>Agendar entrevista</option>
                            <option value="Contratado" {{ $feedback && $feedback->status_processo === 'Contratado' ? 'selected' : '' }}>Contratado</option>
                            <option value="Arquivado" {{ $feedback && $feedback->status_processo === 'Arquivado' ? 'selected' : '' }}>Arquivado</option>
                            <option value="Em análise" {{ $feedback && $feedback->status_processo === 'Em análise' ? 'selected' : '' }}>Em análise</option>
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

                <form method="POST" action="{{ route('curriculosVaga.mail', ['vaga' => $vaga->id, 'user' => $user->id]) }}">
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
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="transferencia_vaga_id" value="{{ $vaga->id }}">
                    
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