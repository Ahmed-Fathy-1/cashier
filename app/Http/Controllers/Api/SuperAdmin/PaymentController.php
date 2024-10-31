<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Enums\packagePaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\PaymentRequest;
use App\Models\Payment;
use App\Models\SuperAdmin\Package;
use App\Models\SuperAdmin\User;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;

class PaymentController extends Controller
{

    public function initiatePayment(PaymentRequest  $request){
        DB::beginTransaction();
        try {
            $packageId =  $request->package_id;
            $package = Package::with('packageDetails')->findOrFail($packageId);

            if ($request->package_type == packagePaymentEnum::MONTHLY->value) {
                $amount = $package->packageDetails->Price_monthly;
            } else {
                $amount = $package->packageDetails->Price_annually;
            }

            if (!$amount) {
                return response()->json(['error' => 'Invalid package price'], 400);
            }

            $stripe = new StripeClient(config('services.stripe.secret'));

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $amount * 100,
                'currency' => 'EGP',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $payment = new Payment();

            $payment->forceFill([
                'user_id' => auth('api')->user()->id,
                'package_id' => $request->package_id,
                'amount' => $amount,
                'domain_name' => $request->domain_name,
                'currency' => $paymentIntent->currency,
                'receipt' => $paymentIntent->receipt_email ?? null,
                'methods' => 'Stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),
            ])->save();

            $paymentData = [
                'id' =>$payment->id,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent' => $paymentIntent->id,
            ];

            DB::commit();

            return  response()->json(['data' => $paymentData]);
        }catch (\Exception $ex){
            DB::rollBack();
            return  response()->json('error on payment process',['error' =>$ex->getMessage()]);
        }
    }


    // public function initiatePayment(PaymentRequest $request)
    // {
    //     $user = User::find($request->user_id);

    //     $user->


    //     StripeGateway::setApiKey(env('STRIPE_KEY'));

    //     try {
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $request->amount * 100, // Multiply as & when required
    //             'currency' => $request->currency,
    //             'automatic_payment_methods' => [
    //                 'enabled' => true,
    //             ],
    //         ]);

    //         // Save the $paymentIntent->id to identify this payment later
    //         $payment = new Payment();

    //         $payment->forceFill([
    //             'user_id' => $user->id,
    //             'package_id' => $request->package_id,
    //             'amount' => $request->amount,
    //             'domain_name' => $request->domain_name,
    //             'currency' => $paymentIntent->currency,
    //             'receipt' => $paymentIntent->receipt_email ?? null,
    //             'methods' => 'Stripe',
    //             'status' => 'pending',
    //             'transaction_id' => $paymentIntent->id,
    //             'transaction_data' => json_encode($paymentIntent),
    //         ])->save();

    //     } catch (\Exception $e) {
    //         return  response()->json('error on payment process: '. $e->getMessage());
    //     }

    //     $data = [
    //         'token' => (string) Str::uuid(),
    //         'client_secret' => $paymentIntent->client_secret,
    //         'payment_intent_id' => $paymentIntent->id,
    //     ];

    //     return  response()->json(['data' => $data]);


    // }

    public function completePayment(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_KEY'));

        // Use the payment intent ID stored when initiating payment
        $paymentDetail = $stripe->paymentIntents->retrieve(   $request->payment_intent_id);

        if ($paymentDetail->status != 'succeeded') {
            return response()->json(['error' => 'Payment failed']);
        }

        // Complete the payment
        return response()->json(['success' => 'Payment Complete']);

    }

    public function failPayment(Request $request)
    {
        // Log the failed payment if you wish
    }







}
