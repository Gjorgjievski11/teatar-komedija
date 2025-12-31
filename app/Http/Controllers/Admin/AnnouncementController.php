<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get(); // or paginate if needed

        return view('admin.pages.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.pages.announcements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'required|string',
            'starts_at'  => 'nullable|date',
            'ends_at'    => 'required|date|after_or_equal:starts_at',
            'is_active'  => 'boolean',
        ]);

        Announcement::create($data);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement created.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.pages.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'required|string',
            'starts_at'  => 'nullable|date',
            'ends_at'    => 'required|date|after_or_equal:starts_at',
            'is_active'  => 'boolean',
        ]);

        $announcement->update($data);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement deleted.');
    }
}
