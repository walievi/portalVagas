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
                    <h4>  {{ __('Candidatos da vaga')}}: {{$vaga->titulo}}</h4>
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
                    @foreach ($vaga->candidaturas as $candidatura)
                    <tr>    
                        <td>{{ $candidatura->user->name }}</td>
                    
                        <td>
                            <div class="p-1 pl-3  {{ $tags[$candidatura->feedback?->status_processo] ?? 'bg-info text-white' }}" style="border-radius: 10px; width: 50%; font-weight: bold; font-size: 14px;">{{ $candidatura->feedback->status_processo ?? '' }}</span>
                        </td>
                           
                        <td>{{ $candidatura->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class='actions'>
                            <a class='btn btn-success btn-xs' href="{{ route('curriculosVaga.show', ['candidatura' => ($candidatura->feedback->status_processo ?? '') == 'Transferido' ? $candidatura->transferencia_vaga : $candidatura->id]) }}"></span> Visualizar</a>
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
