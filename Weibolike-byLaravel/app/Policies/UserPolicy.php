<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /** 所写好的策略需要进行注册才能被使用
     *       注册在认证服务提供器中
     */


    //定义的update策略，用来实现更新数据的用户是不是当前登录的用户
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //实现一个认证，判定当前用户和所操作数据的用户是不相同用户，以及当前的用户是不是拥有管理员权限
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
