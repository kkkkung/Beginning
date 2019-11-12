<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //Test  测试项目连通性
    public function show()
    {
        return view('test');
    }
}
