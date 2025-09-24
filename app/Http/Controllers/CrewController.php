<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Employee;
use App\Models\Play;
use App\Models\PlayEmployee;
use Illuminate\Http\Request;

class CrewController extends Controller
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
    public function create(Play $play)
    {
        return view('admin.pages.crew.create', [
            'play' => $play,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Play $play)
    {
        $validated = $request->validate([
            'crew' => 'required|array',
            'crew.*' => 'integer|exists:employees,id'
        ]);

        foreach ($validated['crew'] as $employeeId) {
            PlayEmployee::create([
                'play_id' => $play->id,
                'employee_id' => $employeeId,
            ]);
        }

        return redirect()->route('admin.crew.edit', $play)
            ->with('alert', ['message' => 'Екипажот беше успешно додаден.']);
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
    public function edit(Play $play)
    {

        return view('admin.pages.crew.edit', [
            'play' => $play,
            'crew' => $play->crew()->paginate(9),
            'contributions' => Contribution::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Play $play)
    {
        // dd($request->all());

        $output = [];

        foreach ($request->all() as $key => $value) {
            if (preg_match('/^(contribution|role)-(\d+)$/', $key, $matches)) {
                [$full, $type, $id] = $matches;
                $output[$id][$type] = $value;
            }
        }

        $output = array_filter($output, function ($item) {
            return !is_null($item['contribution'] ?? null) || !is_null($item['role'] ?? null);
        });

        foreach ($output as $playEmployeeId => $data) {
            $playEmployee = PlayEmployee::find($playEmployeeId);
            $playEmployee->update([
                'contribution_id' => $data['contribution'],
                'role_name' => $data['role']
            ]);
        }

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Успешно беше изменет екипашот.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayEmployee $playEmployee)
    {
        $playEmployee->delete();

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Бришењето беше успешно.']);
    }
}
