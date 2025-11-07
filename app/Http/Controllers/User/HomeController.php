<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Play;
use App\Models\PlayDate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

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

    // Optional: Fallback to next month if no plays this month
        if ($plays->isEmpty()) {
            $startOfNextMonth = $now->copy()->addMonth()->startOfMonth();
            $endOfNextMonth = $now->copy()->addMonth()->endOfMonth();

            $plays = Play::whereHas('dates', function ($query) use ($startOfNextMonth, $endOfNextMonth) {
                $query->whereDate('played_at', '>=', $startOfNextMonth)
                    ->whereDate('played_at', '<=', $endOfNextMonth);
            })
            ->with(['dates' => function ($query) use ($startOfNextMonth, $endOfNextMonth) {
                $query->whereDate('played_at', '>=', $startOfNextMonth)
                    ->whereDate('played_at', '<=', $endOfNextMonth)
                    ->orderBy('played_at');
            }])
            ->latest()
            ->get();
        }

        return view('user.home.index',  compact('plays'));
    }
}
