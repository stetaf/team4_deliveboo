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


  <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

  <script>
      var form = document.querySelector('#payment-form');
      var client_token = "{{ $token }}";
      braintree.dropin.create({
        locale: 'it_IT',
        authorization: client_token,
        selector: '#bt-dropin'
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          return;
        }
        form.addEventListener('submit', function (event) {
          event.preventDefault();
          instance.requestPaymentMethod(function (err, payload) {
            if (err) {
              console.log('Request Payment Method Error', err);
              return;
            }
            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
          });
        });
      });
  </script>