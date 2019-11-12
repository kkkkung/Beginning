## Power By
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## 简单介绍
这是我跟着 <a href="https://laravel-china.org/courses/laravel-essential-training-5.5">Laravel 教程 - Web 开发实战入门 ( Laravel 5.5 )</a> 一章一章跟着做的。
<br>其中我自定义了前端界面（使用了Bootstrap 4），从中教程中学习了 Laravel 框架的一些基础应用，由于 Laravel 版本差异，有些功能的实现可能会很啰嗦，是我根据 Laravel 5.6 文档来实现了相同的功能，在代码中我有给予代码注释说明以帮助学习，该项目仅供学习。

## 主要实现功能
<ul>
<li>注册用户</li>
        <li>发送邮箱予以注册用户权限</li>
        <li>忘记密码找回功能
    <li>登录用户
        <li>用户的登录
        <li>用户的退出
        <li>用户信息的修改 
        <li>用户言论发表和删除
        <li>用户之间的关注与取消关注
</ul>

## 学习总结
一些特别需要注意自认为比较重要的地方
<li> package.json 用于项目 npm 的包管理  install --no-links-bin , run dev
<li> 路由的书写 get ， post , delete , resource ,以及 ->name() 方法
<li> Git 版本控制器的使用
<li> Request 对POST上来的数据进行有消息验证
<li> artisan 的使用，用来创建控制器、模型、数据迁移等
<li> Blade 模板的知识 @session @extends @include @yield {{ code }} {!! code !!} 
<li> 前端页面的设计 Boostrap 4 框架 常用的 class 属性
<li> 前端表单中        {{ method_field('') }}
                  {{ csrf_field() }}
<li> 数据类型的应用， Laravel 提供了有很多方便安全方法的内置类
<li> 中间件的使用， 认证登录，页面转换的控制
<li> Policy 的应用，AuthServiceProvider中注册Policy用来验证数据关系。在 Blade 模板中可以 @can 使用验证
<li> 模型关联的使用， hasOne(), belongsToMany() ......


