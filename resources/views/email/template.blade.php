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
                    <br>

                    <!-- Opções de E-mail -->
                    @if ($email->template == 'abertura_vaga')
                    <div class="form-group mb-2" id="opcoes-container">
                                <label class="form-check-label">Adicionar e-mail para notificação:</label>
                                <input id='input_option' type="text" class="form-control">
                            </div>

                            <div class="form-group mb-2" id="opcoes-container">
                                <button type="button" class="btn btn-primary" id="adicionar-opcao">Adicionar E-mail</button>
                            </div>

                            <div class="form-group mb-2">
                                <input id='options' type="hidden" name="options" value="{{ $email->email ?? '' }}">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 90%;">E-mail</th>
                                            <th style="width: 10%;">Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbodyOptions'>
                                        @foreach($email->EmailList ?? array() as $option)
                                            <tr>
                                                <td class='opcoes'>{{ $option }}</td>
                                                <td><button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    @endif
                    <div class="form-group">
                    <!-- Botão de Salvar -->
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
            </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('adicionar-opcao').addEventListener('click', function() {
        let input   = document.getElementById('input_option');

        let tbody = document.getElementById('tbodyOptions');
        let tr = tbody.insertRow(-1);
        let td = tr.insertCell(0);
        td.textContent = input.value;
        td.classList.add('opcoes');

        tr.insertCell(1).innerHTML = '<button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button>';

        input.value = '';

        attOptions();

    });

    document.getElementById('text_resp').addEventListener('click', function() {
        if(this.checked)
            document.getElementById('opt_resp').style.display = 'none';
        else
            document.getElementById('opt_resp').style.display = 'block';
    });


    function attOptions() {
        let options = document.getElementById('options');

        let conteudos = [];
        let divs = document.querySelectorAll('.opcoes');
        divs.forEach((div) => {
          conteudos.push(div.textContent || div.innerText);
        });

        options.value = JSON.stringify(conteudos);
    }

    function removeOpt(el) {
        el.closest('tr').remove();
        attOptions();
    }
</script>

@endsection
