@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                @include('layouts.partials.errors')
                <div class="card-header">Registra un nuovo account</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2">

                        
                            <div class="col border-right">
                                <h4>Dati utente</h4>

                                <div class="form-group row">
                                    <label for="fullname" class="col-md-4 col-form-label">Nome e cognome  <small style="color:red">*</small></label>

                                    <div class="col-md-6">
                                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                                        @error('fullname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label">Indirizzo email  <small style="color:red">*</small></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label">Password <small style="color:red">*</small></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label">Conferma password <small style="color:red">*</small></label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <h4>Dati ristorante</h4>
        
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">Nome Attivit&agrave;  <small style="color:red">*</small></label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
        
                                        @error('nome_attivita')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label">Indirizzo  <small style="color:red">*</small></label>
        
                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
        
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="piva" class="col-md-4 col-form-label">P.IVA  <small style="color:red">*</small></label>
        
                                    <div class="col-md-6">
                                        <input id="piva" type="text" class="form-control @error('piva') is-invalid @enderror" name="piva" value="{{ old('piva') }}" required autocomplete="piva" minlength="11" maxlength="11">
        
                                        @error('piva')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row justify-content-center">
                                    <label for="tipologie" class="col-12 col-form-label">Tipi di cucina <small style="color:red">*</small></label>
                                    <div class="col">
                                        <div class="container">
                                            <div class="row row-cols-2 row-cols-sm-1 row-cols-md-2">
                                                <div class="col">
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-1" name="tipologie[]" value="1" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-1">Italiano</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-2" name="tipologie[]" value="2" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-2">Cinese</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-3" name="tipologie[]" value="3" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-3">Giapponese</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-4" name="tipologie[]" value="4" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-4">Messicano</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-5" name="tipologie[]" value="5" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-5">Carne</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-6" name="tipologie[]" value="6" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-6">Pesce</small>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-7" name="tipologie[]" value="7" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-7">Pizza</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-8" name="tipologie[]" value="8" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-8">Vegano</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-9" name="tipologie[]" value="9" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-9">Fast Food</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-10" name="tipologie[]" value="10" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-10">Indiano</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-11" name="tipologie[]" value="11" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-11">Pasticceria</small>
                                                    </div>
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="type-12" name="tipologie[]" value="12" style="margin-bottom: 0">
                                                            <small class="form-check-small" for="type-12">Kebab</small>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>

                                    </div>
                                    @error('tipologie')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
        
                                <div class="form-group row">
                                    <div class="col">
                                        <input id="image_file" type="file" @change="getFileName()" class="pt-1 @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" hidden>
                                        <label class="btn btn-sm btn-info text-white m-0" for="image_file">
                                            <i class="fas fa-image mr-1"></i>
                                            Seleziona
                                        </label>
                                        <label for="image" class="justify-self-center m-0" id="image_name">Carica un'immagine del tuo ristorante</label>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-success">
                                        Registrati
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection