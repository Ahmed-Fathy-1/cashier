<?php

namespace App\Http\Controllers\SuperAdmin\Payment;

use App\Enums\packagePaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\PaymentRequest;
use App\Mail\TenantRegisterMail;
use App\Models\Payment;
use App\Models\SuperAdmin\Package;
use App\Models\SuperAdmin\PaymentMethod;
use App\Models\SuperAdmin\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\StripeClient;

class PaymentController extends Controller
{

    public function index()
    {
        $payments = Payment::paginate(10);
        return view('dashboard.payments.index', compact('payments'));
    }


    public function edit($id)
    {
        $packages = Package::all();
        $payment = Payment::findOrFail($id);
        return view('dashboard.payments.edit', compact('payment', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'status' => 'required|string|in:pending,completed,failed,cancelled',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update($validated);

        $user_tanent = User::findOrFail($validated['user_id']);

        // ,'completed','failed','cancelled

        if ($payment->status == 'completed') {

            $tenant = Tenant::create([
                'id' => $payment->domain_name,
                'name' => $payment->domain_name,
                'user_id' => $user_tanent->id,
            ]);

            $tenant->domains()->create([
                'domain' => $payment->domain_name,
            ]);

            try {
                $name = $user_tanent->name;
                $email = $user_tanent->email;
                $password = $user_tanent->password;
                $messageSuperAdmin = 'Create New customer';
                $messageAdmin = 'this is email and password dashboard';
                $phone = $user_tanent->phone;

                Mail::to(env('MAIL_USERNAME'))
                    ->send(mailable: new TenantRegisterMail($name, $email, $password, $messageSuperAdmin, $phone));

                Mail::to($user_tanent->email)
                    ->send(new TenantRegisterMail($name, $email, $password, $messageAdmin, $phone));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
            }

        }

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }

    public function showDeleted()
    {
        $payments = Payment::onlyTrashed()->paginate(10);
        return view('dashboard.payments.deleted', compact('payments'));
    }

    public function forceDelete($id)
    {
        Payment::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('payments.deleted')->with('success', 'Payment Method Permanently Deleted Successfully');
    }
    public function restore($id)
    {
        Payment::withTrashed()->where('id', $id)->restore();
        return redirect()->route('payments.index')->with('success', 'Payment Restored Successfully');
    }
}
