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
    $endOfWeek = $now->copy()->endOfWeek(Carbon::SUNDAY);
    $startOfNextWeek = $endOfWeek->copy()->addDay();
    $endOfNextWeek = $startOfNextWeek->copy()->endOfWeek(Carbon::SUNDAY);

    // Plays with upcoming dates in the current week
    $plays = Play::whereHas('dates', function ($query) use ($now, $endOfWeek) {
        $query->whereDate('played_at', '>=', $now)
              ->whereDate('played_at', '<=', $endOfWeek);
    })
    ->with('dates')
    ->latest()
    ->get();

    // Fallback: next week's plays if none left in current week
    if ($plays->isEmpty()) {
        $plays = Play::whereHas('dates', function ($query) use ($startOfNextWeek, $endOfNextWeek) {
            $query->whereDate('played_at', '>=', $startOfNextWeek)
                  ->whereDate('played_at', '<=', $endOfNextWeek);
        })
        ->with('dates')
        ->latest()
        ->get();
    }

    return view('user.home.index', compact('plays'));
}}
