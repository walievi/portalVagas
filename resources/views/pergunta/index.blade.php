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
                Tem certeza de que deseja excluir esta pergunta?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="deletePerguntaForm" method="POST" action="">
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
    <div class="col-md-11 mt-5">
        <div class="card">
            <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="row">
                <div class="col-md-10">
                    <h4>  {{ __('Perguntas') }}</h4>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('pergunta.create') }}" class="btn btn-dark" >Criar nova pergunta</a>
                </div>
            </div>
            <div class="table-responsive col-md-12">
                <table class="table table-bordered" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                    <th>Pergunta</th>
                    <th>Opções</th>
                    <th>Multiplas respostas</th>
                    <th>Data Criação</th>

                    <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($perguntas as $pergunta)
                    <tr>
                        <td><a href="{{ route('pergunta.show', ['pergunta' => $pergunta->id]) }}">{{ $pergunta->pergunta }}</a></td>
                        <td><?= ($pergunta->freeText) ? '<i>Resposta de texto Livre</i>' : implode('<br>', $pergunta->optionsList) ?></td>
                        <td>{{ $pergunta->freeText ? 'N/A' : ($pergunta->mult_resps ? 'Sim' : 'Não') }}</td>
                        <td>{{ $pergunta->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class='actions'>
                            <a class='btn btn-warning btn-xs' href="{{ route('pergunta.edit', ['pergunta' => $pergunta->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
                            <a class='btn btn-danger btn-xs delete-pergunta-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('pergunta.destroy', ['pergunta' => $pergunta->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>
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

<script>
    $(document).ready(function () {
        $(".delete-pergunta-btn").click(function () {
          var url = $(this).data("url");
          $("#deletePerguntaForm").attr("action", url);
        });
    });
</script>

@endsection
