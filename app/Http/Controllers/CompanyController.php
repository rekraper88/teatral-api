<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'director' => $request->director,
            'actors' => $request->actors,
        ]);
        return response()->json($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $Company)
    {
        return response()->json(['company' => $Company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $Company)
    {
        $Company->update([
            'name' => $request->name,
            'director' => $request->director,
            'actors' => $request->actors,
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $Company)
    {
        $Company->delete();
        return response()->noContent();
    }
}
