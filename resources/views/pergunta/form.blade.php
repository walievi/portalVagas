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
                        <form method="POST" action="{{ isset($pergunta) ? route('pergunta.update', $pergunta->id) : route('pergunta.store') }}">
                            @csrf
                            @if(isset($pergunta))
                                @method('PUT')
                            @endif

                        <div class="form-group mb-2">
                            <label for="pergunta">{{ __('Pergunta') }}</label>
                            <input id="pergunta" type="text" class="form-control @error('pergunta') is-invalid @enderror" name="pergunta" value="{{ $pergunta->pergunta ?? '' }}" required autocomplete="pergunta" autofocus>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="text_resp" for="text_resp" name="text_resp" value='true' {{ ($pergunta->freeText ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                Resposta em texto livre?
                            </label>
                        </div>

                        <div id='opt_resp' style="display: {{ ($pergunta->freeText ?? true) ? 'none' : 'block' }}">
                            <br><br>
                            <div class="form-group mb-2" id="opcoes-container">
                                <label class="form-check-label">Escreva uma opção de resposta:</label>
                                <input id='input_option' type="text" class="form-control">
                            </div>

                            <div class="form-group mb-2" id="opcoes-container">
                                <button type="button" class="btn btn-primary" id="adicionar-opcao">Adicionar Opção</button>
                            </div>

                            <div class="form-group mb-2">
                                <input id='options' type="hidden" name="options" value="{{ $pergunta->options ?? '' }}">

                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 90%;">Opção</th>
                                            <th style="width: 10%;">Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbodyOptions'>
                                        @foreach($pergunta->optionsList ?? array() as $option)
                                            <tr>
                                                <td class='opcoes'>{{ $option }}</td>
                                                <td><button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value='true' id="mult_resps" for="mult_resps" name="mult_resps" {{ ($pergunta->mult_resps ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Permitir múltiplas respostas
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-2 mt-3">
                        <!-- Outros campos da pergunta -->
                        <label for="vagas">Vincular pergunta à vaga:</label>
                        <a href="#" data-toggle="collapse" data-target="#vagas-collapse">Mostrar Vagas</a>
                            <div id="vagas-collapse" class="collapse">
                                <div class="list-group">
                                    @foreach ($vagas as $vaga)
                                        <label class="list-group-item">
                                            <input type="checkbox" name="vagas[]" value="{{ $vaga->id }}" class="form-check-input" {{isset($perguntaVagas) && in_array($vaga->id, $perguntaVagas) ? 'checked' : '' }} >
                                            {{ $vaga->titulo }}
                                        </label>
                                @endforeach
                                </div>
                            </div>
                        </div>



                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('pergunta.index')}}" class="btn btn-secondary">
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
<script type="text/javascript">
    document.getElementById('adicionar-opcao').addEventListener('click', function() {
        let input   = document.getElementById('input_option');

        let tbody = document.getElementById('tbodyOptions');
        let tr = tbody.insertRow(-1);
        let td = tr.insertCell(0);
        td.textContent = input.value;
        td.classList.add('opcoes');

        tr.insertCell(1).innerHTML = '<button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button>';

        input.value = '';

        attOptions();

    });

    document.getElementById('text_resp').addEventListener('click', function() {
        if(this.checked)
            document.getElementById('opt_resp').style.display = 'none';
        else
            document.getElementById('opt_resp').style.display = 'block';
    });


    function attOptions() {
        let options = document.getElementById('options');

        let conteudos = [];
        let divs = document.querySelectorAll('.opcoes');
        divs.forEach((div) => {
          conteudos.push(div.textContent || div.innerText);
        });

        options.value = JSON.stringify(conteudos);
    }

    function removeOpt(el) {
        el.closest('tr').remove();
        attOptions();
    }
</script>

@endsection
