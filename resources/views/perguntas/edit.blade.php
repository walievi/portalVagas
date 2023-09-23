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
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>  {{ __('Editar pergunta') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('editPergunta',  ['id' => $perguntas->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="pergunta">{{ __('Pergunta') }}</label>
                            <input id="pergunta" type="text" class="form-control @error('pergunta') is-invalid @enderror" name="pergunta" value="{{ $perguntas->pergunta }}" required autocomplete="pergunta" autofocus>

                            @error('pergunta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="options">{{ __('Opções') }}</label>
                            <input id="options" type="text" class="form-control @error('options') is-invalid @enderror" name="options" value="{{ $perguntas->options }}" required autocomplete="options" autofocus>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="mult_resps">{{ __('Múltiplas respostas') }}</label>
                            <input id="mult_resps" type="text" class="form-control @error('mult_resps') is-invalid @enderror" name="mult_resps" value="{{ $perguntas->mult_resps }}" required autocomplete="mult_resps" autofocus>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>


                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('perguntas')}}" class="btn btn-secondary">
                                    {{ __('Voltar') }}
                                </a>
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
</div>

@endsection
