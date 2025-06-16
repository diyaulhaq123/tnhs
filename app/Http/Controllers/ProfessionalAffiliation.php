<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessionalAffiliation;

class ProfessionalAffiliation extends Controller
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
        return view('professional_affiliation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
