<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- 导航响应按钮 -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- logo图片 -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{-- config('app.name', 'Laravel') --}}
                <img src="/images/logo.png" width="116" height="22">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- 导航条 -->

            <ul class="nav navbar-nav">
                <li>
                    <a href="">首 页</a>
                </li>
                <li>
                    <a href="">公 告</a>
                </li>
                <li>
                    <a href="">说 说</a>
                </li>
                <li>
                    <a href="">博 客</a>
                </li>
                <li>
                    <a href="">问 答</a>
                </li>
                <li>
                    <a href="">留言板</a>
                </li>
                <li>
                    <a href="">反 馈</a>
                </li>
                <li>
                    <a href="/promise">寄 语</a>
                </li>
            </ul>

            <!-- 导航右侧 -->
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())

                <!-- 登录注册 -->
                    <li>
                        <a href="{{ url('/login') }}">

                            登录
                        </a>
                    </li>

                    <li><a href="{{ url('/register') }}">注册</a></li>
            @else

                <!-- 搜索框 -->
                    <li class="searched" id="search_input">
                        <a style="padding-top: 11px; padding-bottom: 11px;">
                            <input class="form-control" type="text" value="12345" style="border-radius: 5px; width:128px; height: 28px; padding-right: 32px;">
                        </a>
                    </li>
                    <li class="searched" style="margin-left: -60px;" id="search_icon">
                        <a><button class="glyphicon glyphicon-search" style="border: 0; background-color: white; width: 20px; height: 20px;"></button></a>
                    </li>

                    <!-- 消息提醒 -->
                    <li>
                        <a href="">
                            <i class="glyphicon glyphicon-bell"></i>
                            <i class="font-normal"> （252）</i>
                        </a>
                    </li>

                    <!-- 个人中心 -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-top: 10px; padding-bottom: 10px;">
                            <img src="/images/icon.png" width="30" height="30" style="border-radius: 50%; margin-right: 10px;">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" style="padding: 0;">
                            <li>
                                <a href="" style=" padding: 8px 0 8px 30px;">
                                    <i class="glyphicon glyphicon-user"></i><i style="margin-left: 14px;"  class="font-normal"> 个人中心</i>
                                </a>
                            </li>
                            <hr style=" margin: 0">
                            <li>
                                <a href="" style=" padding: 8px 0 8px 30px;">
                                    <i class="glyphicon glyphicon-cog"></i><i style="margin-left: 14px;"  class="font-normal"> 编辑资料</i>
                                </a>
                            </li>
                            <hr style=" margin: 0">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"  style=" padding: 8px 0 8px 30px;">
                                    <i class="glyphicon glyphicon-log-out"></i><i style="margin-left: 14px;"  class="font-normal"> 退出</i>
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>