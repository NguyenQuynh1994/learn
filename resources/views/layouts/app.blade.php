<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>IzziEngLish | Dashboad</title>
    {!! Html::style('assets/plugins/bootstrap/bootstrap.css') !!}
    {!! Html::style('assets/font-awesome/css/font-awesome.css') !!}
    {!! Html::style('assets/plugins/pace/pace-theme-big-counter.css') !!}
    {!! Html::style('assets/css/style.css') !!}
    {!! Html::style('assets/css/main-style.css') !!}

</head>
<body class="body-Login-back">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if (Auth::guest())
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src={{ url('assets/img/logo.png') }} alt=""/>
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/category') }}">
                        <img src={{ url('assets/img/logo.png') }} alt=""/>
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/chart') }}">Kết quả học tập</a></li>
                        <li><a href="{{ url('/createPost') }}">Tạo thảo luận</a></li>
                        <li><a href="{{ url('/post') }}">Thảo luận</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user fa-fw"></i>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-user">
                                {{-- <li>
                                    <a href="{{ url('user/profiles/' . Auth::user()->id) }}">
                                        <i class="fa fa-user fa-fw"></i> User Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('user/profiles/' . Auth::user()->id . '/edit') }}">
                                        <i class="fa fa-gear fa-fw"></i> Settings
                                    </a>
                                </li>
                                <li class="divider"></li> --}}
                                <li>
                                    <a href="{{ url('/logout') }}">
                                        <i class="fa fa-btn fa-sign-out"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    {!! Html::script('assets/plugins/jquery-3.1.1.js') !!}
    {!! Html::script('assets/plugins/bootstrap/bootstrap.min.js') !!}
    {!! Html::script('assets/plugins/metisMenu/jquery.metisMenu.js') !!}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {!! Html::script('js/chart.js') !!}
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/comment_facebook.js') !!}
    {!! Html::script('js/like_share.js') !!}
    {!! Html::script('js/chat.js') !!}
</body>
</html>
