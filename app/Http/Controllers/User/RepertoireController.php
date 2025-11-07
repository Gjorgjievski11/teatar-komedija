<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Play;

class RepertoireController extends Controller
{
    public function index()
    {
        // Load all plays with their dates, ordered by first date
        $plays = Play::with(['dates' => function($query) {
            $query->orderBy('played_at', 'asc');
        }])->get();

        return view('user.repertoire.index', compact('plays'));
    }
}
