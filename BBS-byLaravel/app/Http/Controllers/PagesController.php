<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    public function root()
    {
        $user = Auth::user();
        return view('pages.root', compact('user'));
    }
}
