<?php

namespace App\Http\Controllers\SuperAdmin\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ContactUs;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ContactUs\ContactUsRequest;


class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUs::paginate(10);
        return view('dashboard.contact_us.index', compact('contacts'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactUsRequest $request)
    {
        ContactUs::create($request->validated());
        return response()->json(['message' => 'Your message has been sent successfully.'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('dashboard.contact_us.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = ContactUs::findOrFail($id);
    $contact->delete();

    return redirect()->route('contact-us.index')->with('success', 'Contact entry deleted successfully.');

    }
}
