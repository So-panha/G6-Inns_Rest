<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestHouse;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    //
    // private $stripe;
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

    public function paid(Request $request){
        // find guest house
        $guestHouseId = $request->guestHouseId;
        $guestHouse = GuestHouse::find($guestHouseId);
        // Get current date and time in format 'Y-m-d'
        $date = date('Y-m-d');
        // Activate guest house on map
        $guestHouse->update([
            'active' => 1,
            'day_has' => 30,
            'real_day' => substr($date, 8)
        ]);
        // Save new data of guest house
        $guestHouse->save();

        // create data for payment
        $payment = [
            'guest_house_id' => $request->guestHouseId,
            'amount' => $request->amount,
            'date_paid' => $date,
            'user_id' => Auth()->user()->id
        ];

        // Save payment data
        Transaction::create($payment);

        // return response
        return response()->json(['success' => $guestHouse], 200);
    }

    public function update(Request $request){
        // find guest house
        $guestHouse = GuestHouse::find($request->guest_house_id);
        // Update real day in guest house
        $guestHouse->update([
            'day_has' => $request->dayHas,
            'real_day' => $request->real_day,
            'spend_day' => $request->spend_day
        ]);
        // Save new data of guest house
        $guestHouse->save();
        // return response
        return response()->json(['success' => $request->dayHas]);
    }
}
