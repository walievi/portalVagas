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

            <div class="row mb-3">
                <div class="col-md-11">
                    <h4>  {{ __('Candidaturas da vaga')}}: {{$vaga->titulo}}</h4>
                </div>
            </div>
            <div class="table-responsive col-md-12">
                <table class="table table-bordered" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Status feedback</th>
                    <th>Data Criação</th>

                    <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($curriculos as $curriculo)
                    <tr>    
                        <td><a href="{{ route('curriculosVaga.show', ['vaga' => $vaga->id, 'user' => $curriculo->user->id]) }}">{{ $curriculo->user->name }}</a></td>
                        @if (isset($curriculo->feedback))
                            <td>{{ $curriculo->feedback->status_processo }}/td>
                        @else
                            <td>Pendente</td>
                        @endif
                        <td>{{ $curriculo->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class='actions'>
                            <a class='btn btn-success btn-xs' href="{{ route('curriculosVaga.show', ['vaga' => $vaga->id, 'user' => $curriculo->user->id]) }}"></span> Visualizar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
