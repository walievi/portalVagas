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
                    <form method="POST" action="{{ route('editProfile', ['id' => $user->id]) }}">
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
                    <form method="POST" > 
                        @csrf

                        <div class="form-group mb-2">
                            <label for="nascimento">{{ __('Data de nascimento') }}</label>
                            <input id="nascimento" type="text" class="form-control @error('nascimento') is-invalid @enderror" name="nascimento" value="{{ $user->nascimento }}" required autocomplete="nascimento" autofocus value="{{ $user->nascimento }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="telefone">{{ __('Telefone') }}</label>
                            <input id="telefone" type="tel" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ $user->telefone }}" required autocomplete="telefone">
                        </div>

                        <div class="form-group mb-2">
                            <label for="cep" >{{ __('CEP') }}</label>
                            <input id="cep" type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" autocomplete="new-cep">
                        </div>

                        <div class="form-group mb-2">
                            <label for="rua" >{{ __('Rua') }}</label>
                            <input id="rua" type="text" class="form-control @error('rua') is-invalid @enderror" name="rua" autocomplete="new-rua">
                        </div>

                        <div class="form-group mb-4">
                            <label for="numero">{{ __('Numero') }}</label>
                            <input id="numero" type="text" class="form-control" name="numero" autocomplete="new-numero">
                        </div>

                        <div class="form-group mb-4">
                            <label for="bairro">{{ __('Bairro') }}</label>
                            <input id="bairro" type="text" class="form-control" name="bairro" autocomplete="new-bairro">
                        </div>

                        <div class="form-group mb-2">
                            <label for="cidade">{{ __('Cidade') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="cidade" type="cidade" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade') }}" required autocomplete="cidade">
                                <option value="Novo Hamburgo" selected>Novo Hamburgo</option>
                                <option value="Campo Bom">Campo Bom</option>
                                <option value="Ivoti">Ivoti</option>
                                <option value="Sapiranga">Sapiranga</option>
                            </select>

                            @error('cidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="estado">{{ __('Estado') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="estado" type="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}" required autocomplete="estado">
                                <option value="RS" selected>RS</option>
                                <option value="SC">SC</option>
                                <option value="PR">PR</option>
                                <option value="MT">MT</option>
                            </select>

                            @error('estado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-4">
                            <label for="objetivo">{{ __('Objetivo com a vaga') }}</label>
                            <input id="objetivo" type="text" class="form-control" name="objetivo" autocomplete="new-objetivo">
                        </div>

                        <div class="form-group mb-4">
                            <label for="habilidades">{{ __('Principais Habilidades') }}</label>
                            <input id="habilidades" type="text" class="form-control" name="habilidades" autocomplete="new-habilidades">
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
            <a class='btn btn-danger btn-xs ml-4 delete-user-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('users.destroy', $user->id) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Apagar minha conta</a>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".delete-user-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteUserForm").attr("action", url);
        });
    });
</script>
@endsection