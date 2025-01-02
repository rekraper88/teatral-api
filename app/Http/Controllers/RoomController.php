<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Room::all());
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
        $play_id = $request->play_id ? $request->play_id : null;

        $room = Room::create([
            'name' => $request->name,
            'rows' => $request->rows,
            'cols' => $request->cols,
            'seats' => $request->seats,
            'play_id' => $play_id,
        ]);

        return response()->json($room);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $room->update([
            'name' => $request->name,
            'rows' => $request->rows,
            'cols' => $request->columns,
            'seats' => $request->seats,
        ]);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json([ 'foo' => 'bar']);
    }
}
