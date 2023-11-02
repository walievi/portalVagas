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
    </div>

   
</div>

@endsection