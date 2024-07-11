<x-app-layout>
    <div class="m-4">
        <div class="credit-card w-full sm:w-auto shadow-lg mx-auto rounded-xl bg-white">
            <header class="flex flex-col justify-center items-center">
                <div class="relative" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    <img class="w-full h-auto"
                        src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/svg-cards/card-visa-front.png"
                        alt="front credit card">
                    <div class="front bg-transparent text-lg w-full text-white px-12 absolute left-0 bottom-12">
                        <p class="number mb-5 sm:text-xl">XXXX XXXX XXXX XXXX</p>
                    </div>
                </div>
                <ul class="flex">
                    <li class="mx-2">
                        <img class="w-16"
                            src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/computop.png"
                            alt="" />
                    </li>
                    <li class="mx-2">
                        <img class="w-14"
                            src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/verified-by-visa.png"
                            alt="" />
                    </li>
                    <li class="ml-5">
                        <img class="w-7"
                            src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/mastercard-id-check.png"
                            alt="" />
                    </li>
                </ul>
            </header>
            <form id="payment-form" class="mt-4 p-4">
                <h1 class="text-xl font-semibold text-gray-700 text-center">Card payment</h1>
                <div>
                    <div class="my-3">
                        <P
                            class="w-full h-10 text-center font-bold px-5 py-2 border rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700">
                            10$
                        </P>
                        <input type="text" value="10" name="amount" id="amount" class="hidden">
                    </div>
                    <div class="my-3">
                        <input
                            class="w-full px-5 py-2 border rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                            placeholder="Card holder" maxlength="22" type="text" id="customer_name"
                            name="customer_name" required>
                    </div>
                    <div class="my-3">
                        <div id="card-element"
                            class="w-full px-5 py-2 border rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none">
                        </div>
                    </div>
                </div>

                <button
                    class="submit-button px-4 py-3 rounded-full bg-blue-500 text-blue-900 focus:ring focus:outline-none w-full text-xl font-semibold"
                    type="submit" id="submit-btn">
                    Pay Now
                </button>
                <button
                    class="hidden px-4 py-3 rounded-full bg-blue-300 text-blue-900 w-full text-xl font-semibold flex justify-center"
                    id="spinner">
                    <p class="mr-6 spinner"></p>
                    Proccessing...
                </button>
                <div  class="hidden px-4 py-3 rounded-full bg-green-500 text-white w-full text-xl font-semibold flex justify-center"
                    id="success-message">
                    Payment successful!
                </div>
                <div  class="hidden px-4 py-3 rounded-full bg-red-500 text-white w-full text-xl font-semibold flex justify-center"
                    id="failled-message">
                    Payment failled!
                </div>
            </form>
        </div>
    </div>
    <script>
        // Set up Stripe
        var stripe = Stripe(
            'pk_test_51PYkxIKKLDYvp20Oau5dgsQy1pEIeTcvfUh6J01fyixLNLFivu2sgukZsPVyWaIolu8nRV68rrTJROPHSzGYLDdO00CnLZEuPw'
        );

        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Get the amount from the form
            var name = document.getElementById('customer_name').value;
            var amount = document.getElementById('amount').value;

            // Add a spinner
            var submitButton = document.getElementById('submit-btn');
            var spinner = document.getElementById('spinner');
            var successMessage = document.getElementById('success-message');
            var failledMessage = document.getElementById('failled-message');

            // Hidden the submit button
            submitButton.classList.add('hidden');
            spinner.classList.remove('hidden');
            // Make a request to the backend to create a PaymentIntent
            fetch("/admin/process-payment", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        name: name,
                        amount: amount,
                    }),
                })
                .then(function(response) {
                    return response.text(); // Read the response as text instead of JSON
                })
                .then(function(clientSecret) {
                    // Confirm the PaymentIntent
                    stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: cardElement,
                        },
                    }).then(function(result) {
                        // Remove the spinner
                        spinner.classList.add('hidden');
                        if (result.error) {
                            // Handle payment error
                            failledMessage.classList.remove('hidden');
                            setTimeout(function() {
                                failledMessage.classList.add("hidden");
                                submitButton.classList.remove('hidden');
                            }, 2000);
                            console.error(result.error.message);
                        } else {
                            // Payment succeeded
                            successMessage.classList.remove('hidden');
                            setTimeout(function() {
                                successMessage.classList.add("hidden");
                                submitButton.classList.remove('hidden');
                            }, 2000);
                        }
                    });
                })
                .catch(function(error) {
                    Handle fetch error
                    console.error(error);
                });
        });
    </script>
    
    <style>
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
            -webkit-tap-highlight-color: transparent;
        }

        .submit-button:disabled {
            cursor: not-allowed;
            background-color: #D1D5DB;
            color: #111827;
        }

        .submit-button:disabled:hover {
            background-color: #9CA3AF;
        }

        .credit-card {
            max-width: 420px;
            margin-top: 3rem;
        }

        @media only screen and (max-width: 420px) {
            .credit-card .front {
                font-size: 100%;
                padding: 0 2rem;
                bottom: 2rem !important;
            }

            .credit-card .front .number {
                margin-bottom: 0.5rem !important;
            }
        }

        .spinner {
            font-size: 90%;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            position: relative;
            margin-top: 0.2rem;
            -webkit-animation: load6 1.7s infinite ease;
            animation: load6 1.7s infinite ease;
        }

        @-webkit-keyframes load6 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
            }

            5%,
            95% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
            }

            30% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.51em -0.66em 0 -0.42em #ffffff, -0.75em -0.36em 0 -0.44em #ffffff, -0.83em -0.03em 0 -0.46em #ffffff, -0.81em 0.21em 0 -0.477em #ffffff;
            }

            55% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.29em -0.78em 0 -0.42em #ffffff, -0.43em -0.72em 0 -0.44em #ffffff, -0.52em -0.65em 0 -0.46em #ffffff, -0.57em -0.61em 0 -0.477em #ffffff;
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
            }
        }

        @keyframes load6 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
            }

            5%,
            95% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
            }

            30% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.51em -0.66em 0 -0.42em #ffffff, -0.75em -0.36em 0 -0.44em #ffffff, -0.83em -0.03em 0 -0.46em #ffffff, -0.81em 0.21em 0 -0.477em #ffffff;
            }

            55% {
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.29em -0.78em 0 -0.42em #ffffff, -0.43em -0.72em 0 -0.44em #ffffff, -0.52em -0.65em 0 -0.46em #ffffff, -0.57em -0.61em 0 -0.477em #ffffff;
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
                box-shadow: -0.11em -0.83em 0 -0.4em #ffffff, -0.11em -0.83em 0 -0.42em #ffffff, -0.11em -0.83em 0 -0.44em #ffffff, -0.11em -0.83em 0 -0.46em #ffffff, -0.11em -0.83em 0 -0.477em #ffffff;
            }
        }
    </style>
</x-app-layout>
