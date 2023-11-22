@extends('layouts.app')
@extends('general')

@section('content')
<div class="container">
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Tem certeza de que deseja apagar sua conta?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <br><br>
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
                            <h4>{{ __('Perfil') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('perfil.update', ['perfil' => $user->id]) }}">
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

                        <div class="form-group mb-2">
                            <label for="password" >{{ __('Alterar Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm">{{ __('Confirmação da nova senha') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="form-group mb-2">
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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('successdadospessoais'))
                    <div class="alert alert-success" role="alert">
                        {{ session('successdadospessoais') }}
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>{{ __('Dados pessoais') }}</h4>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('candidato.update', ['candidato' => $user->id]) }}" > 
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-2">
                            <div class="col">
                                <label for="nascimento">{{ __('Data de nascimento') }}</label>
                                <input id="data_nascimento" type="date" class="form-control @error('nascimento') is-invalid @enderror" name="data_nascimento" value="{{ optional($user->dadosPessoais)->data_nascimento }}" required autocomplete="data_nascimento" autofocus>
                            </div>
                            <div class="col">
                                <label for="celular">{{ __('Celular') }}</label>
                                <input id="celular" type="tel" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ isset($user->dadosPessoais->contato) ? $user->dadosPessoais->contato->celular : '' }}" required autocomplete="celular">
                            </div>
                            <div class="col">
                                <label for="telefone">{{ __('Telefone') }}</label>
                                <input id="telefone" type="tel" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ isset($user->dadosPessoais->contato) ? $user->dadosPessoais->contato->telefone : '' }}" required autocomplete="telefone">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col">
                                <label for="cep" >{{ __('CEP') }}</label>
                                <input id="cep" type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" autocomplete="new-cep" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->cep : '' }}">
                            </div>
                            <div class="col">
                                <label for="rua" >{{ __('Rua') }}</label>
                                <input id="rua" type="text" class="form-control @error('rua') is-invalid @enderror" name="rua" autocomplete="new-rua" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->rua : '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col">
                                <label for="numero">{{ __('Numero') }}</label>
                                <input id="numero" type="text" class="form-control" name="numero" autocomplete="new-numero" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->numero : '' }}">
                            </div>
                            <div class="col">
                                <label for="bairro">{{ __('Bairro') }}</label>
                                <input id="bairro" type="text" class="form-control" name="bairro" autocomplete="new-bairro" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->bairro : '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col">
                                <label for="estado">{{ __('Estado') }}</label>
                                <div class="list-group">
                                    <select class="form-select form-select-md mb-3" aria-label="Large select example" id="estado" type="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}" required autocomplete="estado">
                                        @foreach ($estados as $estado)
                                            <label class="list-group-item">
                                            <option value="{{ $estado->id }}" @if ($estado->nome === 'Rio Grande do Sul') selected @endif>
                                                {{ $estado->nome }}
                                            </option>
                                            </label>
                                        @endforeach
                                    </select>
                                </div>

                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="cidade">{{ __('Cidade') }}</label>
                                <select class="form-select form-select-md mb-3" aria-label="Large select example" id="cidade" type="cidade" class="form-control @error('cidade') is-invalid @enderror" name="cidade"  required autocomplete="cidade">
                                    <option value="">Selecione um estado primeiro</option>
                                </select>

                                @error('cidade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                        
                        </div>

                        <div class="form-group mb-4">
                            <label for="habilidades">{{ __('Principais Habilidades') }}</label>
                            <textarea id="habilidades" type="text" class="form-control" name="habilidades" autocomplete="new-habilidades" placeholder="Descreva aqui as suas principais habilidades, hardskills e softskills">{{ isset($user->dadosPessoais) ? $user->dadosPessoais->habilidades : '' }}</textarea>
                        </div>

                        <div class="form-group mb-2">
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

    <div class="row justify-content-center">
        <div class="col-md-8 mb-5">
            <div class="card">
                    @if (session('statusformacao'))
                    <div class="alert alert-success" role="alert">
                        {{ session('statusformacao') }}
                    </div>
                    @endif
                    @include('formacao.index', ['formacoes' => $formacoes])
            </div>

            <div class="card">
                <div class="card-body">
                    @if (session('successcurriculo'))
                        <div class="alert alert-success" role="alert">
                            {{ session('successcurriculo') }}
                        </div>
                    @endif
                    @if ($errors->has('curriculo'))
                        <div class="alert alert-danger">{{ $errors->first('curriculo') }}</div>
                    @endif
                <div class="row mb-3">
                    <div class="col-md-9">
                        <h4>{{ __('Currículo') }}</h4>
                    </div>
                </div>
                @if ($curriculo)
                    <p><h6>Você já possui um currículo em nosso sistema! E pode atualizá-lo no formulário abaixo:</h6></p>
                    <p>Data do primeiro envio: {{ $curriculo->created_at->format('d/m/Y') }}</p>
                    <p>Última atualização: {{ $curriculo->updated_at->format('d/m/Y') }}</p>
                    <a href="{{ route('curriculo.show', [$curriculo->id]) }}" class="btn btn-primary">Visualizar Currículo existente</a>
                @else
                @endif
                <br>
                <form method="POST" action="{{route('curriculo.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-4">
                    <label for="curriculo">{{ __('Anexar no formato PDF') }}</label>
                    <input id="curriculo" type="file" class="form-control @error('curriculo') is-invalid @enderror" name="curriculo" required autofocus>                        </div>
                </div>
                <div class="form-group mb-2">
                    <center>
                        <button type="submit" class="btn btn-dark">
                            {{ __('Salvar') }}
                        </button>
                    </center>
                </div>
            </div>

            <a class='btn btn-danger btn-xs ml-4 delete-user-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('users.destroy', $user->id) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Apagar minha conta</a>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    // exclusao do perfil, pega o click do botao e seta o action do form
    $(document).ready(function () {
        $(".delete-user-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteUserForm").attr("action", url);
        });
    });
    // mascara para o formatar input de celular
    $("#telefone, #celular").mask("(00) 0 0000-0000");
    // mascara para formatar input de cep
    $("#cep").mask("00000-000");
    // mascara para formatar ano de conslusão entino medio
    $("#ensino_medio_conclusao").mask("0000");

</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Função para carregar cidades com base no estado pré-selecionado
    function carregarCidadesParaEstadoSelecionado() {
        var estadoId = $('#estado').val();
        
        if (estadoId) {
            $.ajax({
                url: '/cidades/' + estadoId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#cidade').empty();
                    $('#cidade').append('<option value="">Selecione uma cidade</option>');
                    $.each(data, function(key, value) {
                        $('#cidade').append('<option value="' + value.id + '">' + value.nome + '</option>');
                    });

                }
            });
        } else {
            $('#cidade').empty();
            $('#cidade').append('<option value="">Selecione um estado primeiro</option>');
        }
    }

    // Chame a função quando a página for carregada
    $(document).ready(function() {
        carregarCidadesParaEstadoSelecionado();
    });

    // Adicione um evento change para carregar cidades quando o estado for alterado
    $('#estado').change(function() {
        carregarCidadesParaEstadoSelecionado();
    });
 
    document.getElementById('adicionar-formacao').addEventListener('click', function() {
        let input = document.getElementById('input_option');

        let tbody = document.getElementById('tbodyOptions');
        let tr = tbody.insertRow(-1);
        let td = tr.insertCell(0);
        td.textContent = input.value;
        td.classList.add('opcoes');

        tr.insertCell(1).innerHTML = '<button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button>';

        input.value = '';

        attOptions();

    });
</script>

@endsection