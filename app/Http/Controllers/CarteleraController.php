<?php

namespace App\Http\Controllers;

use App\Models\Cartelera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarteleraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plays = DB::table('plays')
            ->join('cartelera', 'plays.id', '=', 'cartelera.play_id')
            ->select('plays.*', DB::raw('cartelera.id AS cartelera_id'))
            ->get();
        return response()->json($plays);
        // return response()->json(Cartelera::all());
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
    public function store(Request $request)
    {
        if (count(Cartelera::all()) >= 4) {
            return response()->json(['error' => 'No puede haber mas de 4 obras en la cartelera']);
        } else {
            Cartelera::create([
                'play_id' => $request->play_id
            ]);

            $play = DB::table('plays')
                ->join('cartelera', 'plays.id', '=', 'cartelera.play_id')
                ->select('plays.*', DB::raw('cartelera.play_id AS is_in_cartelera'), DB::raw('cartelera.id AS cartelera_id'))
                ->where(['play_id' => $request->play_id])
                ->first();
            return response()->json($play);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cartelera $cartelera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cartelera $cartelera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cartelera $cartelera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartelera $cartelera)
    {
        $cartelera->delete();
        return response()->json($cartelera);
    }
}
