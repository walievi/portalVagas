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
                    <form method="POST" action="{{ route('candidato.edit') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="name">{{ __('Nome') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

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
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>{{ __('Dados pessoais') }}</h4>
                        </div>
                    </div>
                    <!-- Adicionar metodo action="{{ route('editProfile', ['id' => $user->id]) }}" -->

                    <form method="POST" action="{{ route('candidato.update', ['id' => $candidato->id]) }}" >
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="nascimento">{{ __('Data de nascimento') }}</label>
                            <input id="data_nascimento" type="date" class="form-control @error('nascimento') is-invalid @enderror" name="data_nascimento" value="" required autocomplete="data_nascimento" autofocus>
                        </div>

                        <div class="form-group mb-2">
                            <label for="telefone">{{ __('Telefone') }}</label>
                            <input id="telefone" type="tel" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ isset($user->dadosPessoais->contato) ? $user->dadosPessoais->contato->telefone : '' }}" required autocomplete="telefone">
                        </div>

                        <div class="form-group mb-2">
                            <label for="cep" >{{ __('CEP') }}</label>
                            <input id="cep" type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" autocomplete="new-cep" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->cep : '' }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="rua" >{{ __('Rua') }}</label>
                            <input id="rua" type="text" class="form-control @error('rua') is-invalid @enderror" name="rua" autocomplete="new-rua" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->rua : '' }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="numero">{{ __('Numero') }}</label>
                            <input id="numero" type="text" class="form-control" name="numero" autocomplete="new-numero" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->numero : '' }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="bairro">{{ __('Bairro') }}</label>
                            <input id="bairro" type="text" class="form-control" name="bairro" autocomplete="new-bairro" value="{{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->bairro : '' }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="estado">{{ __('Estado') }}</label>

                                <div class="list-group">
                                <select class="form-select form-select-md mb-3" aria-label="Large select example" id="estado" type="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}" required autocomplete="estado">
                                    @foreach ($estados ?? [] as $estado)
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


                        <div class="form-group mb-2">
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



                        <div class="form-group mb-4">
                            <label for="objetivo">{{ __('Objetivo com a vaga') }}</label>
                            <textarea id="objetivo" type="text" class="form-control" name="objetivo" autocomplete="new-objetivo" placeholder="Breve descrição com seu objetivo com a vaga">{{ isset($user->dadosPessoais) ? $user->dadosPessoais->objetivo_vaga : '' }}</textarea>
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
</script>

@endsection