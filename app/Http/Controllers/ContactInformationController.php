<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;

class ContactInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contactInfo = ContactInformation::where('user_id', auth()->id())->first();
        return view('contact_information.create', compact('contactInfo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'place_of_work' => 'required|string|max:120',
            'department' => 'nullable|string|max:100',
            'position' => 'required|string|max:100',
            'professional_field' => 'required|string|max:120',
            'official_address' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:12',
            'whatsapp_number' => 'required|string|max:12',
            'email' => 'required|email|max:120',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->id) {
            ContactInformation::where('id', $request->id)->where('user_id', auth()->id())->update($validated);
            return redirect(route('academic-qualification.create'))->with('success', 'Contact Information updated.');
        } else {
            ContactInformation::create($validated);
            return redirect()->back()->with('success', 'Contact Information saved.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactInformation $contactInformation)
    {
        //
    }
}
