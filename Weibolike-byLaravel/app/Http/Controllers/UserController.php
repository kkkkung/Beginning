<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //使用中间件
    public function __construct()
    {
        //使用认证的中间件，对控制器的方法进行登录用户的认证
        $this->middleware('auth', [
            //一下控制方法不需要用户登录
            'except' => ['show', 'create', 'store', 'index', 'completeConfirmEmail']
        ]);
        $this->middleware('guest', [
            //访客只能使用如下的控制方法
            'only' => ['create']
        ]);
    }

    //注册页面
    public function create()
    {
        //如果用户已经登录那么就重定向到主页面，并给出提示信息
        if (Auth::check())
            return redirect()->back()->with('warning', 'You have been sign in, don\'t need to sign up again. ');
        /**
         * view 函数的简介
         * Get the evaluated view contents for the given view.
         *
         * @param  string  $view
         * @param  array   $data
         * @param  array   $mergeData
         * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
         */
        return view('users.create');
    }

    //注册信息处理
    public function store(Request $request)
    {
        //验证提交的信息是否符合要求
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //使用模型对数据进行存储
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        //注册后实现自动登录
//        Auth::login($user);
//        session()->flash('success', '欢迎，您将在这儿开始一段奇妙的旅程');
//        return redirect()->route('users.show', [$user]);

        //掉用发送邮箱给用户的方法，给用户发送激活邮件
        $this->sendEmailConfirmationTo($user);
//        session()->flash('warning', 'Please check your Email to active your account and sign in');
        return redirect('/')->with('warning', 'Please check your Email to active your account and sign in');
    }

    //显示用户的主页面
    public function show(User $user)
    {
        // compact() 函数将传递进来的 User 类对象内的数据转换成列表并作为参数传递给view函数
        $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(5);
        /** 注意，view方法接受的数据是一个数组类型的值 */
        return view('users.show',compact('user','statuses'));
    }

    //用户信息修改页面
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //用户提交修改信息到该控制器，该控制器对数据进行处理
    //修改用户信息
    public function update(User $user, Request $request)
    {
        //验证数据是否通过update策略
        //即，验证提交信息的用户是否是当前登录的用户
        $this->authorize('update', $user);
        //对数据使用validate函数过滤
        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        //创建一个数组，用来保存所需要修改的数据
        $data = [];
        $data['name'] = $request->name;
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }
        //使用模型的update方法来保存修改的内容
        $user->update($data);
        session()->flash('success', 'Success Edit!');
        return redirect()->route('users.show', $user->id);
    }

    //显示所有用户的页面
    public function index()
    {
        //在调用 paginate 方法时会收到一个 Illuminate\Pagination\LengthAwarePaginator 实例
        //在调用 simplePaginate 方法时会收到一个 Illuminate\Pagination\Paginator 实例
        //这些对象提供了一些用于渲染结果集的函数。除了这些辅助函数，分页器实例是一个迭代器，可以作为数组循环
        //这里我们使用Eloquent模型paginate方法对模型数据进行分页显示
        //在view中插入{{ $users->link() }} 会链接渲染到结果集中其余的页面
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    //删除用户
    public function destroy(User $user)
    {
        //验证数据是否能通过destroy策略
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', "Success to DELETE the user!");
        return back();
    }

    //确认收到激活邮箱，通过激活邮件get这个网页所所用到的控制器方法
    //激活用户
    public function completeConfirmEmail($activation_token)
    {
        //通过get的URL里传递的激活码（activation token）找到用于这个激活码的用户
        $user = User::where('activation_token',$activation_token)->firstOrFail();
        //修改这个用户的激活信息
        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        //实现自动登录
        Auth::login($user);
        session()->flash('success', 'Congratulation ! You have been confirmed your email activated your account');
        return redirect()->route('users.show',$user);
    }

    //发送激活邮件到用户的邮箱
    protected function sendEmailConfirmationTo($user)
    {
        $to = $user->email;
        //===================
        //编写一个邮件
        //使用 php artisan make:mail MailTypeName生成一个 Mailable 类，用来编写以恶搞邮件的内容
        //===================
        //发送一个邮件
        //调用Illuminate\Support\Facades\Mail类的to方法
        //to方法接受一个邮件地址，如果传递一个对象活视集合，mailer会自动使用Email和name属性来设置邮件收件人
        //一旦指定收件人，就可以传递一个实现到 Mailable类的send方法，传递是一个 Mailable 类的实例
        //实现一个邮件的发送
        Mail::to($to)->send(new ConfirmEmail($user));
    }

    //显示正在关注的用户的页面
    public function followings(User $user)
    {
        $users = $user->followers()->paginate(20);
        $title = "Followings";
        return view('users.show_follow', compact('users', 'title'));
    }

    //显示粉丝的页面
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(20);
        $title = "Followers";
        return view('users.show_follow', compact('users', 'title'));
    }
}
