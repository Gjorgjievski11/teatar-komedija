<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Play;
use App\Models\PlayEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $crew = $play->playEmployees()
            ->with(['employee', 'contributions']) // eager load
            ->get();

        return view('admin.pages.crew.edit', [
            'play' => $play,
            'crew' => $crew,
            'contributions' => Contribution::all(),
        ]);
    }

    /**
     * Update play employees (roles and multiple contributions).
     */
    public function update(Request $request, Play $play)
    {
        // load all play employees for this play
        $crew = PlayEmployee::where('play_id', $play->id)->get();

        // build validation rules dynamically per play employee
        $rules = [];
        foreach ($crew as $pe) {
            $rules['contribution-' . $pe->id] = ['nullable', 'array'];
            $rules['contribution-' . $pe->id . '.*'] = ['integer', 'exists:contributions,id'];
            $rules['role-' . $pe->id] = ['nullable', 'string', 'max:255'];
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($crew, $request) {
            foreach ($crew as $pe) {
                // sync pivot only if the field was present in the request
                $contributionKey = 'contribution-' . $pe->id;
                if ($request->has($contributionKey)) {
                    // filter out empty values from template selects
                    $selected = array_filter((array) $request->input($contributionKey, []), function ($v) {
                        return (string)$v !== '';
                    });
                    $pe->contributions()->sync($selected);
                }

                // update role_name if provided (editable now)
                $roleKey = 'role-' . $pe->id;
                if ($request->has($roleKey)) {
                    $pe->role_name = $request->input($roleKey);
                    $pe->save();
                }
            }
        });

        // return to admin play index after saving
        return redirect()->route('admin.play.index')->with('alert', ['message' => 'Екипажот беше успешно зачуван.']);
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
