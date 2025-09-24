<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.contribution.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.contribution.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:contributions,name|max:255',
        ]);

        Contribution::create($validated);

        return redirect()->route('admin.contribution.index')
            ->with('alert', ['message' => 'Contribution беше успешно додадена']);
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
    public function edit(Contribution $contribution)
    {
        return view('admin.pages.contribution.edit', ['contribution' => $contribution]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contribution $contribution)
    {
        if ($contribution->name === $request['name'])
            return redirect()->route('admin.contribution.index')
                ->with('alert', ['message' => 'Нема направени промени.', 'type' => 'info']);

        $validated = $request->validate([
            'name' => 'required|unique:job_positions,name|max:255',
        ]);

        $contribution->update(['name' => $validated['name']]);

        return redirect()->route('admin.contribution.index')
            ->with('alert', ['message' => 'Промените беа успешно зачувани.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribution $contribution)
    {
        $contribution->delete();
        return redirect()->route('admin.contribution.index')
            ->with('alert', ['message' => 'Уеспешно беше избришана позицијата.']);
    }
}
