@extends('layouts.app')

@section('content')
  @include ('layouts.partials.message')
  @include ('layouts.partials.errors')

  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-6 py-4">
        <h2>Effettua il pagamento</h2>
        <h4>
          <i class="fas fa-coins" style="color: #decd2e"></i>
          Totale: € {{ $order_total }}
        </h4>
        <form method="POST" id="payment-form" action="{{ url('/pay') }}">
            @csrf
            <div class="input-wrapper amount-wrapper">
                <input id="amount" name="amount" type="hidden" min="1" placeholder="Amount" value="{{ $order_total }}">
            </div>
          
            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
            
            <textarea name="order" id="order" hidden cols="30" rows="10">{{ json_encode($order) }}</textarea>
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <div class="d-flex justify-content-between">
              <a href="{{ Route('guests.restaurant.checkout', $restaurant->id) }}">
                <span class="btn btn-sm btn-secondary">
                  Torna indietro
                </span>
              </a>
              <button class="btn btn-sm btn-success" type="submit"><span>Effettua il pagamento</span></button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection