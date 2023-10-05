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
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>{{ __('Formação') }}</h4>
                        </div>
                    </div>
                    <!-- Adicionar metodo action="{{ route('editProfile', ['id' => $user->id]) }}" -->
                    <form method="POST" > 
                        @csrf

                        <h6>Ensino Médio</h6>
                        <div class="form-group mb-2">
                            <label for="ensino_medio_local">{{ __('Local') }}</label>
                            <input id="ensino_medio_local" type="text" class="form-control @error('ensino_medio_local') is-invalid @enderror" name="ensino_medio_local" value="{{ $user->ensino_medio_local }}" required autocomplete="ensino_medio_local" autofocus value="{{ $user->ensino_medio_local }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="ensino_medio_conclusao">{{ __('Ano de conclusão') }}</label>
                            <input id="ensino_medio_conclusao" type="text" class="form-control @error('ensino_medio_conclusao') is-invalid @enderror" name="ensino_medio_conclusao" value="{{ $user->ensino_medio_conclusao }}" required autocomplete="ensino_medio_conclusao" autofocus value="{{ $user->ensino_medio_conclusao }}">
                        </div>

                        <h6>Ensino Superior</h6>
                        <div class="form-group mb-2">
                            <label for="curso">{{ __('Curso') }}</label>
                            <input id="curso" type="tel" class="form-control @error('curso') is-invalid @enderror" name="curso" value="{{ $user->curso }}" required autocomplete="curso">
                        </div>

                        <div class="form-group mb-2">
                            <label for="universidade" >{{ __('Universidade') }}</label>
                            <input id="universidade" type="text" class="form-control @error('universidade') is-invalid @enderror" name="universidade" autocomplete="new-universidade">
                        </div>

                        <div class="form-group mb-2">
                            <label for="inicio_superior" >{{ __('Data de início') }}</label>
                            <input id="inicio_superior" type="date" class="form-control @error('inicio_superior') is-invalid @enderror" name="inicio_superior" autocomplete="new-inicio_superior">
                        </div>

                        <div class="form-group mb-4">
                            <label for="fim_superior">{{ __('Previsão de conclusão') }}</label>
                            <input id="fim_superior" type="text" class="form-control" name="fim_superior" autocomplete="new-fim_superior">
                        </div>

                        <h6>Outro curso de graduação? Se sim:</h6>
                        <div class="form-group mb-4">
                            <label for="segundo_curso">{{ __('Curso') }}</label>
                            <input id="segundo_curso" type="text" class="form-control" name="segundo_curso" autocomplete="new-segundo_curso">
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="segunda_universidade">{{ __('Universidade') }}</label>
                            <input id="segunda_universidade" type="text" class="form-control" name="segunda_universidade" autocomplete="new-segunda_universidade">
                        </div>

                        <div class="form-group mb-4">
                            <label for="inicio_graduacao">{{ __('Data de início') }}</label>
                            <input id="inicio_graduacao" type="text" class="form-control" name="inicio_graduacao" autocomplete="new-inicio_graduacao">
                        </div>


                        <div class="form-group mb-4">
                            <label for="fim_graduacao">{{ __('Conclusão') }}</label>
                            <input id="fim_graduacao" type="text" class="form-control" name="fim_graduacao" autocomplete="new-fim_graduacao">
                        </div>

                        <h6>Cursos Complementares</h6>
                        <div class="form-group mb-4">
                            <label for="ingles">{{ __('Língua Inglesa:') }}</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Não
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="local_ingles">{{ __('Se sim, onde o curso foi realizado?') }}</label>
                            <input id="local_ingles" type="text" class="form-control" name="local_ingles" autocomplete="new-local_ingles">
                        </div>

                        <div class="form-group mb-4">
                            <label for="duracao_ingles">{{ __('Duração do curso') }}</label>
                            <input id="duracao_ingles" type="text" class="form-control" name="duracao_ingles" autocomplete="new-duracao_ingles">
                        </div>

                        <div class="form-group mb-4">
                            <label for="idioma">{{ __('Fluência em outro idioma?') }}</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Não
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="local_idioma">{{ __('Se sim, qual?') }}</label>
                            <input id="local_idioma" type="text" class="form-control" name="local_idioma" autocomplete="new-local_idioma">
                        </div>

                        <div class="form-group mb-4">
                            <label for="cursos_complementares">{{ __('Outros cursos complementares? Quais?') }}</label>
                            <input id="cursos_complementares" type="text" class="form-control" name="cursos_complementares" autocomplete="new-cursos_complementares">
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