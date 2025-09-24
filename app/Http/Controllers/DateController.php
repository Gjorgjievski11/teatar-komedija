<?php

namespace App\Http\Controllers;

use App\Jobs\CreateGoogleEvent;
use App\Jobs\DeleteGoogleEvent;
use App\Jobs\UpdateGoogleEvent;
use App\Models\Play;
use App\Models\PlayDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Play $play)
    {
        return view('admin.pages.date.create', [
            'play' => $play,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Play $play)
    {
        $validated = $request->validate([
            'dates' => 'required|array|min:1',
            'dates.*' => 'required|date',
            'times' => 'required|array|min:1',
            'times.*' => 'required|date_format:H:i', // use the correct format
        ]);


        $count = count($validated['dates']);

        for ($i = 0; $i < $count; $i++) {
            CreateGoogleEvent::dispatch($validated['dates'][$i], $validated['times'][$i], $play);
        }

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Датите беа успешно додадени.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlayDate $date)
    {
        return view('admin.pages.date.edit', [
            'date' => $date,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlayDate $date)
    {

        // dd($request->all());
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $startDate = Carbon::parse($validated['date'] . ' ' . $validated['time'])->addDay();

        UpdateGoogleEvent::dispatch($date->google_calendar_id, $startDate);

        $date->update([
            'played_at' => $startDate,
        ]);

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Датите беа успешно додадени.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayDate $date)
    {
        DeleteGoogleEvent::dispatch($date->google_calendar_id);

        $date->delete();

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Датата беше успешно избиршана.']);
    }
}
