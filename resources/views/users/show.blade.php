@extends('layouts.app')

@section('title', '个人中心')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')
    <div class="container" style="background-color: white; border-radius: 8px; font-size: 17px;">
        <div style="margin: 40px auto; width: 580px; position: relative; left: -50px;">
            <img src="/images/{{ $user->avatar }}" width="120" height="120" style="border-radius: 50%; float: left; margin-right: 40px;">
            <div style="float: left;">
                <span style="margin-right: 90px; font-size: 36px;">{{ $user->name }}</span>
                <a href="{{ url('/users/'.$user->id.'/edit') }}" style="margin-right: 20px;">编辑资料</a>
                <a href="{{ url('/users/'.$user->id.'/set') }}">系统设置</a><br><br>

                <span style="width: 260px; display: inline-block;">
                    城&nbsp;&nbsp;&nbsp;市：{{ $user->city }}
                </span>
                工&nbsp;&nbsp;&nbsp;作：{{ $user->job }}
                <br><br>

                <span style="width: 260px; display: inline-block;">
                    性&nbsp;&nbsp;&nbsp;别：
                    @if($user->sex == 0)
                        未知
                    @endif
                    @if($user->sex == 1)
                        男
                    @endif
                    @if($user->sex == 2)
                        女
                    @endif
                </span>
                经验值：{{ $user->accumulate_points * 10 }}
                <br><br>

                <span style="width: 260px; display: inline-block;">
                    访问量：{{ $user->visitors }}
                </span>
                积&nbsp;&nbsp;&nbsp;分：{{ $user->accumulate_points }}
                <br><br>

                <span style="width: 260px; display: inline-block;">
                    粉丝数：{{ $user->followers_count }}
                </span>
                关注数：{{ $user->followings_count }}
                <br><br>

                个性签名：<br>
                <div style="width: 420px;">
                    <span style="display: inline-block; width: 82px;">&nbsp;</span>
                    {{ $user->signature }}
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>


    </div>
@endsection