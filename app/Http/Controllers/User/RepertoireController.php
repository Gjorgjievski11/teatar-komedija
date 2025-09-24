<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepertoireController extends Controller
{
    public function index()
    {
        return view('user.repertoire.index');
    }
}
