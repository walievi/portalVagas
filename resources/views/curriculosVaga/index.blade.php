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
                        <div class="col-md-12">
                            <h4>{{ __('Candidatos da vaga')}}: {{$vaga->titulo}}</h4>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                        <!-- Adicionando o formulário de filtro -->
                        <form method="post" action="{{ route('curriculosVaga.filtro', ['vaga' => $vaga->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>Filtros:</label>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">Com Ensino Superior</label>
                                    <select name="nivel_estudo_id" id="nivel_estudo_id">
                                        <option value="">Selecione</option>
                                        @foreach($niveis_estudo as $id => $nivel)
                                            <option value="{{ $id }}">{{ $nivel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Adicione outros filtros conforme necessário -->

                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </form>

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
                                                <div class="p-1 pl-3  {{ $tags[$candidatura->feedback?->status_processo] ?? 'bg-info text-white' }}" style="border-radius: 10px; width: 50%; font-weight: bold; font-size: 14px;">{{ $candidatura->feedback->status_processo ?? '' }}</div>
                                            </td>
                                            <td>{{ $candidatura->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td class='actions'>
                                                <a class='btn btn-success btn-xs' href="{{ route('curriculosVaga.show', ['candidatura' => ($candidatura->feedback->status_processo ?? '') == 'Transferido' ? $candidatura->id : $candidatura->id]) }}">Visualizar</a>
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
</div>

@endsection
