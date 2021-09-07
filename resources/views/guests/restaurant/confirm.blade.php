@extends('layouts.app')

@section('content') 
  <div class="container">
    <div class="row py-5 d-flex justify-content-center">
        @include ('layouts.partials.message')
        <div class="col-9">
            <div class="card text-center p-5 d-flex flex-column flex align-items-center ">
                <span class="fs-35">
                    <i class="far fa-check-circle text-success"></i>
                </span>
        
                <h2>Grazie per aver acquistato su Deliveboo!</h2>
                <h3 class="mt-3">A breve riceverai una email di conferma del tuo ordine.</h3>
            </div>
        </div>
        <div class="col-12 text-center my-4">
            <a href="{{ Route('home') }}">
                <span class="btn btn-sm btn-secondary">
                    Torna alla homepage
                </span>
            </a>
        </div>
    </div>
  </div>
@endsection