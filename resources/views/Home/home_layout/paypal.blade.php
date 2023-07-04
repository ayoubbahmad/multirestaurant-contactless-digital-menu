
<script>
var total = document.getElementById('total').value;
var currency = document.getElementById('currency').value;
  function initPayPalButton() {
    let buttons;
    let hasRendered = false;  

    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',
      },

      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{"amount":{"currency_code":currency,"value":total}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          @this.paypal(orderData);
          // Or go to another URL:  actions.redirect('thank_you.html');
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();

</script>