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
                            <h4>  {{ __('Cadastrar pergunta') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('createPergunta') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="pergunta">{{ __('Pergunta') }}</label>
                            <input id="pergunta" type="text" class="form-control @error('pergunta') is-invalid @enderror" name="pergunta" value="{{ old('pergunta') }}" required autocomplete="pergunta" autofocus>

                            @error('pergunta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2" id="opcoes-container">
                            @if (isset($pergunta) && !empty($pergunta->options))
                                @php
                                    $opcoes = unserialize($pergunta->options); // Desserialize as opções
                                @endphp

                                @foreach ($opcoes as $key => $opcao)
                                    <input type="text" class="form-control @error('options.' . $key) is-invalid @enderror" name="options[]" value="{{ $opcao }}" required autocomplete="options" autofocus>
                                    <br>
                                @endforeach
                            @endif
                        </div>




                            <!-- Campo para adicionar novas opções -->
                            <button type="button" class="btn btn-primary" id="adicionar-opcao">Adicionar Opção</button>
                            @error('status')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="1" id="mult_resps" for="mult_resps" name="mult_resps">
                            <label class="form-check-label" for="flexCheckDefault">
                                Permitir múltiplas respostas
                            </label>
                        </div>

                        <div class="form-group mb-2 mt-3">
                        @csrf
                        <!-- Outros campos da pergunta -->
                        <label for="vagas">Vincular pergunta à vaga:</label>
                        <a href="#" data-toggle="collapse" data-target="#vagas-collapse">Mostrar Vagas</a>
                            <div id="vagas-collapse" class="collapse">
                                <div class="list-group">
                                    @foreach ($vagas as $vaga)
                                        <label class="list-group-item">
                                            <input type="checkbox" name="vagas[]" value="{{ $vaga->id }}" class="form-check-input">
                                            {{ $vaga->titulo }}
                                        </label>
                                @endforeach
                                </div>
                            </div>
                        </div>                       

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('perguntas')}}" class="btn btn-secondary">
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
<script>
    document.getElementById('adicionar-opcao').addEventListener('click', function() {
        var container = document.getElementById('opcoes-container');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'opcoes[]';
        input.className = 'form-control';
        input.required = true;
        
        container.appendChild(input);
    });
</script>
@endsection
