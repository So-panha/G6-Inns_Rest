<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    //
    private $stripe;
    public function showPaymentForm()
    {
        return view('payment.payment');
    }

    public function createStripePaymentIntent(Request $request)
    {
        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a PaymentIntent to charge a customer
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'description' => 'Example Payment',
                'metadata' => [
                    'name' => $request->input('customer_name'),
                ],
            ]);

            // Return the client_secret directly
            return $paymentIntent->client_secret;
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
