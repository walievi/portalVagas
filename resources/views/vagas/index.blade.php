@extends('layouts.app')
@extends('general')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-5">
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="row">
            <div class="col-md-9">
                <h4>  {{ __('Vagas') }}</h4>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-primary">Criar nova vaga</button>
            </div>
        </div>
        <div class="table-responsive col-md-12">
          <table class="table table-bordered" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>Título</th>
                <th>Status</th>
                <th>Data Criação</th>

                <th class="actions">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Professor Ens. Fundamental</td>
                <td>Aberta</td>
                <td>15/09/2023</td>
                <td class='actions'>
                  <a class='btn btn-warning btn-xs' btn-block' href='#' data-toggle='modal' data-target='#autorizar' onClick=''><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
                  <a class='btn btn-danger btn-xs' btn-block' href='#' data-toggle='modal' data-target='#autorizar' onClick=''><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

@endsection
