<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    //
    public function __construct()
    {
        //使用中间件过滤掉一个只能是通过了Auth的用户才能使用的控制方法
        //没有登录的用户只能访问create方法
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //Show the page of login
    public function create(){
        return view('sessions.create');
    }

    //判断用户登录信息是否有效  具体实现是使用Auth类的attempt方法,如果数据成功会建立一个会话并返回一个bool
    public function store(Request $request){
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        //attempt 方法会接收一个数组来作为第一个参数，该参数提供的值将用于寻找数据库中的用户数据。
        if (Auth::attempt($credentials, $request->has('remember'))){
            if (Auth::user()->activated){
                session()->flash('success', 'Welcome back！');
                return redirect()->intended(route('users.show', [Auth::user()]));
            }else{
                Auth::logout();
                session()->flash('warning', 'Please check your email and active your account!');
                return redirect('/');
            }
        } else {
            session()->flash('danger', 'Fault to Sign in');
            return redirect()->back();
        }

    }

    //退出登录
    public function destroy(){
        //直接使用 Auth 类的 logout 方法就能完成会话的退出。
        Auth::logout();
        session()->flash('success', 'You are quited！');
        return redirect('login');
    }
}
