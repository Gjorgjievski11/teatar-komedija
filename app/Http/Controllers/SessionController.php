<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.calendar.index');
        } else {
            return back()->withErrors([
                'loginErr' => 'Погрешна лозинка или е-маил.',
            ])->onlyInput('email');
        }
    }

    public function destroy() {
        Auth::logout();

        return redirect()->route('login');
    }
}
