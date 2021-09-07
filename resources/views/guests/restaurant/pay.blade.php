@extends('layouts.app')

@section('content')
  @include ('layouts.partials.message')
  @include ('layouts.partials.errors')

  <div class="content">
    <form method="POST" id="payment-form" action="{{ url('/pay') }}">
        @csrf
        <section>
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
            </label>

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>
  </div>
@endsection