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
                        <h4>{{ __('Formulário da vaga') }}: <span style="font-weight: normal;font-size: smaller;">{{ $vaga->titulo }}</span></h4>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('candidatar.update', ['candidatar' => $vaga->id]) }}" > 
                    @if (count($perguntas) > 0)
                    @csrf
                    @method('PUT')

                        <input type="hidden" name="vaga_id" value="{{ $vaga->id }}">
                        @foreach ($perguntas as $pergunta)
                            <div class="pergunta mb-3">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][]" value="{{ $pergunta->id }}">
                                <label class="mb-1">{{ __($pergunta->pergunta) }}</label><br>
                                
                                @if ($pergunta->options)
                                    @php
                                        $options = json_decode($pergunta->options);
                                    @endphp
                                    @foreach ($options as $option)
                                        @if ($pergunta->mult_resps)
                                            <input type="checkbox" class="form-check-input" name="respostas[{{ $pergunta->id }}][]" value="{{ $option }}"> {{ $option }}
                                        @else
                                            <input type="radio" class="form-check-input" name="respostas[{{ $pergunta->id }}]" value="{{ $option }}"> {{ $option }}
                                        @endif
                                    @endforeach
                                @else
                                    <input type="text" class="form-control" name="respostas[{{ $pergunta->id }}]"><br>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p>Não há perguntas para exibir para esta vaga.</p>
                    @endif

                        


                        <div class="form-group mb-2 mt-5">
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
       
    </div>
</div>
<!-- Modal -->

<script>
    // exclusao do perfil, pega o click do botao e seta o action do form
    $(document).ready(function () {
        $(".delete-user-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteUserForm").attr("action", url);
        });
    });
    // mascara para o formatar input de celular
    $("#telefone, #celular").mask("(00) 0 0000-0000");
    // mascara para formatar input de cep
    $("#cep").mask("00000-000");
    // mascara para formatar ano de conslusão entino medio
    $("#ensino_medio_conclusao").mask("0000");

</script>



@endsection