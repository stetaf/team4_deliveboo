@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registra un nuovo account</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h4>Dati utente</h4>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome e cognome  <small style="color:red">*</small></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Indirizzo email  <small style="color:red">*</small></label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password <small style="color:red">*</small></label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma password <small style="color:red">*</small></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <hr>

                        <h4>Dati ristorante</h4>

                        <div class="form-group row">
                            <label for="nome_attivita" class="col-md-4 col-form-label text-md-right">Nome Attivit&agrave;  <small style="color:red">*</small></label>

                            <div class="col-md-6">
                                <input id="nome_attivita" type="text" class="form-control @error('nome_attivita') is-invalid @enderror" name="nome_attivita" value="{{ old('nome_attivita') }}" required autocomplete="nome_attivita">

                                @error('nome_attivita')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="indirizzo" class="col-md-4 col-form-label text-md-right">Indirizzo  <small style="color:red">*</small></label>

                            <div class="col-md-6">
                                <input id="indirizzo" type="text" class="form-control @error('indirizzo') is-invalid @enderror" name="indirizzo" value="{{ old('indirizzo') }}" required autocomplete="indirizzo">

                                @error('indirizzo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="piva" class="col-md-4 col-form-label text-md-right">P.IVA  <small style="color:red">*</small></label>

                            <div class="col-md-6">
                                <input id="piva" type="text" class="form-control @error('piva') is-invalid @enderror" name="piva" value="{{ old('piva') }}" required autocomplete="piva">

                                @error('piva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipologie" class="col-md-4 col-form-label text-md-right">Tipi di cucina <small style="color:red">*</small></label>
                            

                            <div class="col-md-6">
                                <select class="custom-select" name="tipologie[]" multiple required>
                                    <option selected>Seleziona almeno una tipologia</option>
                                    <option value="1">Italiano</option>
                                    <option value="2">Cinese</option>
                                    <option value="3">Giapponese</option>
                                    <option value="4">Messicano</option>
                                    <option value="5">Carne</option>
                                    <option value="6">Pesce</option>
                                    <option value="7">Pizza</option>
                                    <option value="8">Vegano</option>
                                    <option value="9">Fast Food</option>
                                    <option value="10">Indiano</option>
                                    <option value="11">Pasticceria</option>
                                    <option value="12">Kebab</option>
                                </select>

                                @error('tipologie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Immagine</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="pt-1 @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrati
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
