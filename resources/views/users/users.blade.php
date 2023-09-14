@extends('layouts.app')
@extends('general')

@section('content')
<div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Usuarios') }}


                    <div class="table-responsive col-md-12">
          <table class="table table-bordered" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Data Criação</th>

                <th class="actions">Ações</th>
              </tr>
            </thead>
            <tbody>

                
                 <tr>
                @foreach ($users as $user)
                    
                 <td>{{ $user->name }} </td>
                 <td>{{ $user->email }}</td>
                 <td>{{$user->created_at}}</td>


                 
                  
                

               <td class='actions'>
             
               <a class='btn btn-warning btn-xs' btn-block' href='#' data-toggle='modal' data-target='#autorizar' onClick=''><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
               <a class='btn btn-danger btn-xs' btn-block' href='#' data-toggle='modal' data-target='#autorizar' onClick=''><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>

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
