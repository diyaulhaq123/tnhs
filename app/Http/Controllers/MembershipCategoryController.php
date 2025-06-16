<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\MembershipCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MembershipCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membership_categories = MembershipCategory::all();
        return view('membership_category.index', compact('membership_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('membership_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|integer'
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            MembershipCategory::create($data);
            return redirect()->back()->with('success', 'Member category was created');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipCategory $membershipCategory)
    {
        //  return view('membership_category.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipCategory $membershipCategory)
    {
         return view('membership_category.edit', compact('membershipCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MembershipCategory $membershipCategory)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|integer'
        ]);
        try{
            DB::beginTransaction();
            DB::commit();
            $membershipCategory->update($data);
            return redirect()->back()->with('success', 'Member Category was updated');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipCategory $membershipCategory)
    {
         try{
            $membershipCategory->delete();
            return redirect()->back()->with('success', 'Member category removed');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }
}
