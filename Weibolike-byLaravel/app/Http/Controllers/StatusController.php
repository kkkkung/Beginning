<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    //整个控制区使用Auth中间件，需要对用户登录进行认证
    public function __construct()
    {
        $this->middleware('auth');
    }

    //保存微消息
    public function store(Request $request)
    {
        //检验数据的有效性
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        //通过user模型访问到属于该用户的微信息，然后调用create方法对模型创建新的微消息
        Auth::user()->statuses()->create([
            'content' => $request['content'],
        ]);
        return redirect()->back();

    }

    //删除微消息
    public function destroy(Status $status)
    {
        //认证用户是否授权，第一个参数是所注册的授权策略名称，第二个为进行授权验证的数据
        $this->authorize('destroy', $status);
        //使用Eloquent模型实现删除的功能
        $status->delete();
        //重定向
        return redirect()->back()->with('success', 'Success deleted!');
    }
}
