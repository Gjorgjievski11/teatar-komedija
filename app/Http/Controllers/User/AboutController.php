<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Play;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $plays = Play::whereDate('created_at', '>=', now()->subWeek())->latest()->get();
        return view('user.about.index',compact('plays'));
    }

    public function collective(){
        return view('user.about.collective');
    }

    public function documents() {
        return view('user.about.documents');
    }
}
