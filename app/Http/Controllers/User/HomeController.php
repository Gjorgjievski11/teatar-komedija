<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Play;
use App\Models\PlayDate;
use App\Models\Announcement;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Fetch plays for the current month
        $plays = Play::whereHas('dates', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('played_at', [$startOfMonth, $endOfMonth]);
            })
            ->with(['dates' => function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('played_at', [$startOfMonth, $endOfMonth])
                      ->orderBy('played_at', 'asc')
                      ->limit(1);
            }])
            ->orderBy(
                PlayDate::select('played_at')
                    ->whereColumn('play_dates.play_id', 'plays.id')
                    ->whereBetween('played_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('played_at', 'asc')
                    ->limit(1)
            )
            ->get();

        // Fallback to next month if no plays this month
        if ($plays->isEmpty()) {
            $startOfNextMonth = $now->copy()->addMonth()->startOfMonth();
            $endOfNextMonth = $now->copy()->addMonth()->endOfMonth();

            $plays = Play::whereHas('dates', function ($query) use ($startOfNextMonth, $endOfNextMonth) {
                    $query->whereBetween('played_at', [$startOfNextMonth, $endOfNextMonth]);
                })
                ->with(['dates' => function ($query) use ($startOfNextMonth, $endOfNextMonth) {
                    $query->whereBetween('played_at', [$startOfNextMonth, $endOfNextMonth])
                          ->orderBy('played_at', 'asc');
                }])
                ->latest()
                ->get();
        }

        // Fetch all currently active announcements (within start and end dates)
        $announcements = Announcement::where('is_active', true)
            ->where('starts_at', '<=', $now)
            ->where('ends_at', '>=', $now)
            ->latest()
            ->get();

        return view('user.home.index', compact('plays', 'announcements'));
    }
}
