    <div class="modal fade" id="confirmDeleteModalformacao" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir esta formação?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteFormacaoForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">

       

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-10">
                            <h4>  {{ __('Formações') }}</h4>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('formacao.create') }}" class="btn btn-dark" >Inserir nova formação</a>
                        </div>
                    </div>
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                                <th>Nível</th>
                                <th>Curso</th>
                                <th>Instituição</th>
                                <th class="actions">Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($formacoes as $formacao)
                                <tr>
                                    <td>{{ $formacao->nivelEstudo->nivel }}</td>
                                    <td>{{ $formacao->curso }}</td>
                                    <td>{{ $formacao->instituicao }}</td>
                                    <td class='actions'>
                                        <a class='btn btn-warning btn-xs' href="{{ route('formacao.edit', ['formacao' => $formacao->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
                                        <a class='btn btn-danger btn-xs delete-pergunta-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModalformacao' data-url="{{ route('formacao.destroy', ['formacao' => $formacao->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
<script>
    $(document).ready(function () {
        $(".delete-pergunta-btn").click(function () {
            var url = $(this).data("url");
            $("#deleteFormacaoForm").attr("action", url);
        });
    });
</script>
