<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessionalAffiliation;

class ProfessionalAffiliationController extends Controller
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
        $affiliations = ProfessionalAffiliation::where('user_id', auth()->id())->get();
        return view('professional_affiliation.create', compact('affiliations')  );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affiliation' => 'required|array',
            'affiliation.*' => 'required|string|max:255',
        ]);

        foreach ($request->affiliation as $aff) {
            ProfessionalAffiliation::create([
                'user_id' => auth()->id(),
                'affiliation' => $aff,
            ]);
        }

        return redirect()->back()->with('success', 'Affiliations saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfessionalAffiliation $professionalAffiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfessionalAffiliation $professionalAffiliation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfessionalAffiliation $professionalAffiliation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfessionalAffiliation $professionalAffiliation)
    {
        $affiliation = ProfessionalAffiliation::where('id', $professionalAffiliation->id)->where('user_id', auth()->id())->firstOrFail();
        $affiliation->delete();

        return redirect()->back()->with('success', 'Affiliation deleted.');
    }
}
