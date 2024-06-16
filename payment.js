const stripe = Stripe('your-public-key-from-stripe');
const elements = stripe.elements();

const style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

const card = elements.create('card', { style: style });
card.mount('#card-element');

const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const { error, paymentIntent } = await stripe.createPaymentMethod({
        type: 'card',
        card: card,
        billing_details: {
            name: form.querySelector('input[name="name"]').value
        },
    });

    if (error) {
        // Inform the user if there was an error.
        const errorElement = document.getElementById('card-errors');
        errorElement.textContent = error.message;
    } else {
        // Send paymentMethod.id to your server
        const response = await fetch('/create-payment-intent', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ amount: 1000 }) // Amount in cents
        });

        const { clientSecret } = await response.json();
        const { error: confirmError, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: paymentMethod.id
        });

        if (confirmError) {
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = confirmError.message;
        } else {
            // Payment succeeded
            alert('Payment succeeded!');
        }
    }
});
