<?php

namespace App\Http\Controllers;

use App\Models\Play;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Play::all());
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
        $play = Play::create([
            'title' => $request->title,
            'argument' => $request->argument,
            'author' => $request->author,
            'duration' => $request->duration,
            'company_id' => $request->company_id,
        ]);

        return response()->json($play);
    }

    public function change_company(Request $request)
    {
        DB::table('plays')->where('id', $_GET['play_id'])->update(['company_id' => $request->company_id]);
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(Play $play)
    {
        $schedules = DB::table('schedules')->where('play_id', $play->id)->get();

        if (isset($_GET['refetch'])) {
            return response()->json($play);
        }

        if (count($schedules)) {
            $rooms_with_schedule = DB::table('rooms')
                ->join('schedules', 'schedules.room_id', '=', 'rooms.id')
                ->where('schedules.play_id', $play->id)
                ->select('rooms.*', DB::raw('schedules.id AS schedule_id'), 'schedules.day', 'schedules.start_time', 'schedules.end_time')
                ->get();
            return response()->json(['play' => $play, 'rooms_with_schedule' => $rooms_with_schedule, 'company' => DB::table('companies')->where('id', $play->company_id)->select('name')->first(), 'rooms' => DB::table('rooms')->get()]);
        } else {
            return response()->json(['play' => $play, 'company' => DB::table('companies')->where('id', $play->company_id)->select('name')->first(), 'rooms' => DB::table('rooms')->get()]);
        }
    }

    public function get_schedules_for_room()
    {
        $room_id = $_GET['room_id'];
        $schedules = DB::table('schedules')
            ->join('plays', 'schedules.play_id', '=', 'plays.id')
            ->where('room_id', $room_id)
            ->select('schedules.*', 'plays.title')
            ->get();
        return response()->json(['schedules' => $schedules]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Play $play)
    {
        return response()->json($play);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Play $play)
    {
        $play->update([
            'title' => $request->title,
            'argument' => $request->argument,
            'author' => $request->author,
            'duration' => $request->duration,
        ]);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Play $play)
    {
        DB::table('schedules')->where('play_id', $play->id)->delete();
        $play->delete();
        return response()->noContent();
    }
}
