@extends('general')

@section('page')
	<h1>Login</h1>

    <form action="{{ route('autenticacao.login') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
@endsection