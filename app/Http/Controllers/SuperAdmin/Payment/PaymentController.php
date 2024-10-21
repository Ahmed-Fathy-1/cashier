<?php

namespace App\Http\Controllers\SuperAdmin\Payment;

use App\Enums\packagePaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\PaymentRequest;
use App\Models\Payment;
use App\Models\SuperAdmin\Package;
use App\Models\SuperAdmin\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class PaymentController extends Controller
{

     public function index(){
         $payments = Payment::paginate(10);
         return view('dashboard.payments.index',compact('payments'));
     }

     public function create(){
         $packages = Package::get();
         return view('dashboard.payments.create',compact('packages'));
     }

    public function store(Request $request)
    {
        Payment::create($request->validate([
                'package_id' => 'required|exists:packages,id',
                'amount' => 'required|numeric|min:0.01',
                'currency' => 'required|string|size:3',
            ]) + ['user_id' => auth()->id()]);

        return redirect()->route('payments.index')->with('success', 'Payment created.');
    }

    public function status(Request $request)
    {
        $payment = Payment::findOrFail($request->id);
        if ($payment->status == "completed"){
            $payment->update([
                'status' => "pending",
            ]);
        }else{
            $payment->update([
                'status' => "completed",
            ]);
        }

        return redirect()->route('payments.index')->with('success', 'Payment created.');
    }

     public function edit($id){
         $packages = Package::all();
         $payment = Payment::findOrFail($id);
         return view('dashboard.payments.edit',compact('payment','packages'));
     }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($request->validate([
                'package_id' => 'required|exists:packages,id',
                'amount' => 'required|numeric|min:0.01',
                'currency' => 'required|string|size:3',
            ]) + ['user_id' => auth()->id()]);
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

     public function destroy(Request $request, $id){
         return $id ;
         $payment = Payment::findOrFail($id);
         $payment->delete();
         return redirect()->route('payments.index');
     }



}
