@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">


<div class="row justify-content-center">

    <div class="col-md-12 mt-5">
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

        <div class="card">
            <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

       
            <div class="table-responsive col-md-12">
            
            <h2>Editar Modelo de E-mail</h2>
            <form method="POST" action="{{ route('email.update.modelo.email', ['template' => $email->template]) }}">
                @csrf
                @method('PUT')

                    <!-- Conteúdo do E-mail -->
                    <div class="form-group">
                        <label for="conteudo">Conteúdo do E-mail:</label>
                        <textarea class="form-control" id="conteudo" name="conteudo" rows="12">{{ $email->conteudo }}</textarea>
                    </div>

                    <!-- Botão de Salvar -->
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>



            </div>
            </div>
        </div>
    </div>
</div>


@endsection
