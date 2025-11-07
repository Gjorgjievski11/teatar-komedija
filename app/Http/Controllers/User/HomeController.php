<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Play;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Plays with dates in the current month
        $plays = Play::whereHas('dates', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereDate('played_at', '>=', $startOfMonth)
                ->whereDate('played_at', '<=', $endOfMonth);
        })
        ->with(['dates' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereDate('played_at', '>=', $startOfMonth)
                ->whereDate('played_at', '<=', $endOfMonth)
                ->orderBy('played_at');
        }])
        ->latest()
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

        return view('user.home.index', compact('plays'));
    }
}
