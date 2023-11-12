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

            <div class="row">
            
            </div>
            <div class="table-responsive col-md-12">
            <h2>Modelos de E-mail</h2>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Abertura de Vaga</h5>
                        <p class="card-text">
                            Visualize e edite o modelo de e-mail para notificar a abertura de uma nova vaga.
                        </p>
                        <a href="{{ route('email.editar.modelo.email', ['template' => 'abertura_vaga']) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Retorno ao Candidato</h5>
                        <p class="card-text">
                            Visualize e edite o modelo de e-mail para dar retorno ao candidato sobre sua candidatura.
                        </p>
                        <a href="{{ route('email.editar.modelo.email', ['template' => 'retorno_candidato']) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection
