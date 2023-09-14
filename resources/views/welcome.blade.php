@extends('layouts.app')
@extends('general')

@section('content')
<div class="background">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="margin: 0 auto">
                        <h5 class="card-title">Professor infantil</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="{{ route('login') }}" class="btn btn-dark"> Candidate-se</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="margin: 0 auto">
                        <h5 class="card-title">Professor infantil</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="{{ route('login') }}" class="btn btn-dark" >Candidate-se</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="margin: 0 auto">
                        <h5 class="card-title">Professor infantil</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="{{ route('login') }}" class="btn btn-dark">Candidate-se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
