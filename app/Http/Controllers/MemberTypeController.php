<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemberTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member_types = MemberType::get();
        return view('nhs.member_types.index', compact('member_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nhs.member_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'fee' => 'required|numeric',
            'status' => 'required|integer'
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            MemberType::create($data);
            return redirect()->back()->with('success', 'Member Type was created');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberType $memberType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberType $memberType)
    {
        return view('nhs.member_types.edit', compact('memberType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberType $memberType)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'fee' => 'required|numeric',
            'status' => 'required|integer'
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            $memberType->update($data);
            return redirect()->back()->with('success', 'Member Type was updated');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberType $memberType)
    {
        try{
            $memberType->delete();
            return redirect()->back()->with('success', 'Member Type was deleted');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }
}
