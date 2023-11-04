@extends('layouts.app')
@extends('general')

@section('content')
<br>
<div class="container">
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
    <div class="col-md-12">
        @if(Auth::user()->role == 'user')
        <h2 class="text-center mt-5"> Olá,  {{ Auth::user()->name }} </h2>
        <p  class="text-center">Envie seu currículo online e venha trabalhar conosco!</p>
        @endif

        @if(Auth::user()->role == 'admin')
        <h2 class="text-center mt-5">{{ __('Vagas disponíveis') }}</h2>
        <p  class="text-center">Gerencie suas vagas em aberto!</p>
        @endif
    </div>
    <div class="row justify-content-center mt-5">
        @foreach ($vagas as $vaga)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body card-body-home" style="margin: 0 auto">
                    <h5 class="card-title">{{ $vaga->titulo }}</h5>
                    <div class="row">
                        <div class="col-md-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $vaga->unidade }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'user')
                    <a href="{{ route('candidatar.index', $vaga->id ) }}" class="btn btn-dark mt-3"> Candidate-se</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
