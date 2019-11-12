<header class="masthead mb-auto mr-5 ml-5 pb-5">
    <div class="inner">
        <h3 class="masthead-brand"><a href="{{ route('home') }}" style="text-decoration: none">Simple APP</a></h3>
        <nav class="nav nav-masthead justify-content-center">
            @if (Auth::check())
                <a class="nav-link" href="{{ route('users.index') }}">All User</a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <b class="caret"></b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">Home Page</a>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">Edit</a>
                            <a class="dropdown-item" id="logout" href="#">
                                <form action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-block btn-danger" type="submit" name="button">LogOut</button>
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            @else
                <a class="nav-link @if(Request::getPathInfo()==route('home'))'active'@endif }}" href="{{ route('home') }}">Home</a>
                <a class="nav-link" href="{{ route('signup') }}">注册</a>
                <a class="nav-link" href="{{ route('login') }}">登录</a>
            @endif

            </nav>
    </div>
</header>