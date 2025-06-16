<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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
        $documents = Document::where('user_id', auth()->id())->get();
        return view('document.create', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:2048', // 2MB limit
        ]);

        $filename = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('public/documents', $filename);

        Document::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'file' => $filename,
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document = Document::where('id', $document->id)->where('user_id', auth()->id())->firstOrFail();

        // Delete file from storage
        Storage::delete('public/documents/' . $document->file);

        $document->delete();

        return redirect()->back()->with('success', 'Document deleted.');
    }
}
