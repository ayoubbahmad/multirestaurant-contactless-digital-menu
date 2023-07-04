
    <script type="text/javascript" >
        // Create an instance of the Stripe object with your publishable API key
        var stripeid = document.getElementById('stripe_details').value;
        var stripe = Stripe(stripeid);
        var view_id = document.getElementById('getStoreid').value;
        var checkoutButton = document.getElementById('checkout-button');
        window.livewire.on('openstripepay', orderId =>  {
            console.log('test');
            fetch('{{url('/stripestatus/')}}'+"/"+orderId+"/"+view_id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token()}}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({plan_id:orderId})
            })
                .then(function(response) {
                    return response.json();
                })
                .then(function(session) {
                    return stripe.redirectToCheckout({ sessionId: session.id });
                })
                .then(function(result) {
                    if (result.error) {
      
                    }
                })
                .catch(function(error) {
                    console.log("err");
                    alert('PAYMENT_ERROR #404');
                    console.error('Error:', error);
                });
        });
      </script>