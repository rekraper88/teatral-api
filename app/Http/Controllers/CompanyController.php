<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function show(Company $company)
    {
        $plays = DB::table('plays')->where('company_id', $company->id)->get();
        return response()->json(['company' => $company, 'plays' => $plays]);
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

    public function edit(Company $company)
    {
        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        DB::table('schedules')->whereIn('play_id', function ($query) use ($company) {
            $query->select('id')
                ->from('plays')
                ->where('company_id', $company->id);
        })->delete();
        DB::table('plays')->where('company_id', $company->id)->delete();

        $company->delete();
        return response()->noContent();
    }
}
