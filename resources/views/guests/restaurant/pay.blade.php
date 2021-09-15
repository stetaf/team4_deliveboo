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
            <textarea name="order_data" id="order_data" hidden value=""></textarea>

            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <div class="d-flex justify-content-between" id="pay_nav">
              <a href="{{ Route('guests.restaurant.checkout', $restaurant->id) }}">
                <span class="btn btn-sm btn-secondary">
                  <i class="fas fa-arrow-left mr-1"></i>
                  Torna indietro
                </span>
              </a>
              <button class="btn btn-sm btn-success" type="submit">
                <i class="fas fa-credit-card mr-1"></i>
                <span>Effettua il pagamento</span>
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection