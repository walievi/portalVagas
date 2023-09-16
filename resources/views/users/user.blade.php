@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h4>  {{ __('Usuarios') }}</h4>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('user') }}" class="btn btn-primary" >Adicionar usuário</a>
        </div>
    </div>
</div>
@endsection
