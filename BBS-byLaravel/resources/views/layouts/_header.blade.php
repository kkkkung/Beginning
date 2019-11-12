<nav class="navbar navbar-expand-lg navbar-light navbar-static-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{--Left Side Of Navbar--}}
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link" href="{{ route('topics.index') }}">话题</a></li>
                <li class="nav-item {{ active_class(if_route('categories.show') && if_route_param('category',1)) }}"><a class="nav-link" href="{{ route('categories.show', 1) }}">分享</a></li>
                <li class="nav-item {{ active_class(if_route('categories.show') && if_route_param('category',2)) }}"><a class="nav-link" href="{{ route('categories.show', 2) }}">教程</a></li>
                <li class="nav-item {{ active_class(if_route('categories.show') && if_route_param('category',3)) }}"><a class="nav-link" href="{{ route('categories.show', 3) }}">问答</a></li>
                <li class="nav-item {{ active_class(if_route('categories.show') && if_route_param('category',4)) }}"><a class="nav-link" href="{{ route('categories.show', 4) }}">公告</a></li>
            </ul>

            {{--Right side Of Navbar--}}
            <ul class="navbar-nav justify-content-end">
                {{--Authentication Links--}}
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('topics.create') }}" class="nav-link"><span class="fa fa-lg fa-plus" aria-hidden="true"></span></a></li>
                        <li class="nav-item"><a href="{{ route('notifications.index') }}" class="nav-link"><span class="badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'danger' : 'secondary'  }}" title="消息提醒">{{ Auth::user() ->notification_count}}</span></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="user-avatar pull-left" style="margin-right: 8px; margin-top: -5px;">
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                                </span>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                                    <i class="fa fa-user mr-2" aria-hidden="true"></i>个人中心
                                </a>
                                <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                                    <i class="fa fa-edit mr-2" aria-hidden="true"></i>编辑资料
                                </a>
                                <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();return false">
                                    <i class="fa fa-sign-out mr-2" aria-hidden="true"></i>退出登录
                                </a>

                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>