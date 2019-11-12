<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //The Home Page Of this Web
    //在首页面显示用户所关注的用户（包括自己）的微讯息
    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('public.home', compact('feed_items'));
    }
}
