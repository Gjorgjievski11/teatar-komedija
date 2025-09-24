<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Play;

class HomeController extends Controller
{
    public function index()
    {
        $plays = Play::whereDate('created_at', '>=', now()->subWeek())->latest()->get();

        return view('user.home.index', compact('plays'));
    }
}
