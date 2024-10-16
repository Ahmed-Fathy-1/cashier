<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function payPackage(PaymentRequest  $request){
        DB::beginTransaction();
        try {
            $stripe = new StripeClient(config('services.stripe.secret'));
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $request->price * 100,
                'currency' => 'egp',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $payment = new Payment();
            $payment->forceFill([
                'user_id' => auth('api')->user()->id,
                'package_id' => $request->package_id,
                'amount' => $paymentIntent->amount,
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




















}
