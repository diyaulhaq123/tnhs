<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Models\AcademicQualification;

class AcademicQualificationController extends Controller
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
   public function create(Request $request)
    {
        // Fetch all academic qualifications for the logged-in user
        $academicQualifications = AcademicQualification::with('qualification')->where('user_id', auth()->id())->get();

        // Fetch list of qualifications (e.g., "BSc", "MSc", "PhD") from Qualification model
        $qualifications = Qualification::pluck('name', 'id')->toArray();

        // Initialize a variable to hold a specific qualification if editing
        $academicQualification = null;

        // If an ID is passed, fetch the specific qualification for editing
        if ($request->id) {
            $academicQualification = AcademicQualification::with('qualification')
                ->where('id', $request->id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        return view('academic_qualification.create', compact(
            'academicQualifications',
            'qualifications',
            'academicQualification'
        ));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'qualification_id' => 'required|integer',
            'year_start' => 'required|date_format:Y',
            'year_end' => 'required|date_format:Y',
        ]);
        $data['user_id'] = auth()->id();
        AcademicQualification::create($data);

        return redirect()->route('academic-qualification.create')->with('success', 'Academic Qualification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicQualification $academicQualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicQualification $academicQualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicQualification $academicQualification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicQualification $academicQualification)
    {
        $academicQualification->delete();
        return redirect()->route('academic-qualification.create')->with('success', 'Academic Qualification deleted successfully.');

    }
}
