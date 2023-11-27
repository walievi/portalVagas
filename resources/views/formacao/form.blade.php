@extends('layouts.app')
@extends('general')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ isset($formacao) ? route('formacao.update', $formacao->id) : route('formacao.store') }}">
                            @csrf
                            @if(isset($formacao))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="nivel_estudo_id">Nível de Estudo</label>
                                <select class="form-control" id="nivel_estudo_id" name="nivel_estudo_id" required>
                                    <option value="">Selecione um nível de estudo</option>
                                    @foreach($niveis as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($formacao) && $formacao->nivel_estudo_id == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="curso">Curso</label>
                                <input type="text" class="form-control" id="curso" name="curso" value="{{ $formacao->curso ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="instituicao">Instituição</label>
                                <input type="text" class="form-control" id="instituicao" name="instituicao" value="{{ $formacao->instituicao ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="data_inicio">Data de Início</label>
                                <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ $formacao->data_inicio ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="data_fim">Data de Término</label>
                                <input type="date" class="form-control" id="data_fim" name="data_fim" value="{{ $formacao->data_fim ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observações</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3">{{ $formacao->observacao ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                            <a href="{{ route('profile') }}" class="btn btn-secondary  mt-4">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
