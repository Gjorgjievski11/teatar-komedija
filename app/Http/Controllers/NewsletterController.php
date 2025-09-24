<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke()
    {
        return view('admin.pages.newsletter.index');
    }
}
