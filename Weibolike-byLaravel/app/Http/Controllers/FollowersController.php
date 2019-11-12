<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class FollowersController extends Controller
{
    public function __construct()
    {
        //启用中间件认证
        $this->middleware('auth');
    }

    //对用户是否关注一个人进行逻辑认证，并调用用户的方法关注用户
    public function store(User $user)
    {
        if (Auth::user()->id === $user->id){
            return redirect('/');
        }
        if (!Auth::user()->isFollowing($user->id)){
            Auth::user()->follow($user->id);
        }
        return redirect()->back();
    }

    //对用户是否关注一个人进行逻辑认证，并调用用户的方法取消关注用户
    public function destroy(User $user)
    {
        if (Auth::user()->id === $user->id){
            return redirect('/');
        }
        if (Auth::user()->isFollowing($user->id)){
            Auth::user()->unfollow($user->id);
        }
        return redirect()->back();
    }
}
