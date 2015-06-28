<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Match info</title>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/global-chinese.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/heropedia.css') }}" rel="stylesheet" type="text/css" />
        @yield('styles')
        <script type="text/javascript" src="{{ asset('/js/app.js')}}"></script>
        @yield('scripts')
    </head>
    <body>
        <nav class="navbar navbar-default" id="container-header">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">MyDotA</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/hero/index')}}">英雄</a></li>
                        <li><a href="{{url('/item/index')}}">物品</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ url('/auth/login') }}">登陆</a></li>
                            <li><a href="{{ url('/auth/register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/auth/logout') }}">登出</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div id="bodyContainer clearfix">
            <!-- OUR CODE WILL BE THERE -->
            @yield('content')
        </div>
    </body>
</html>