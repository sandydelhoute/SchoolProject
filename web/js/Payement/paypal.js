$(document).ready(function(){
    var totalPrice = $( 'span#total-price' ).text();
    var price = totalPrice.replace( '€', '.' );

    paypal.Button.render({

        env: 'sandbox', // Or 'sandbox',
        client: {
          sandbox: 'ARebGGmI1oCq7raGMVAqZbOz6NpA1r7PGZWLe-9YDc2uRsSTCjQrsG7DaEV_BnjSlXra6Te025FScFK-',
          production: 'AWoWXnw6_s8uCqTMszYI8WJn6sndvcuIUh5ysZ7ANQwLG5JYSaIuVg6WNuTfYX-F3AfoLqvj_PB-sQfc'
        },

        commit: true, // Show a 'Pay Now' button

        payment: function(data, actions) {
            return actions.payment.create({
              payment: {
                transactions: [
                  {
                    amount: { total: price, currency: 'EUR' }
                  }
                ]
              }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {
              window.alert( 'Paiement réussi.' );
            });
       }

    }, '#bouton-paypal-container');
});
