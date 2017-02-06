@extends('layouts.app')

@section('title', '个人中心')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')
    <div class="container">
        用户名：{{ $user->name }}<br>
        <img src="/images/{{ $user->avatar }}" width="60" height="60" style="border-radius: 50%;"><br>
        手机号：{{ $user->tel }}<br>
        邮箱：{{ $user->email }}<br>
        粉丝数：{{ $user->followers_count }}<br>
        关注数：{{ $user->followings_count }}<br>
        访问量：{{ $user->visitors }}<br>
        积分：{{ $user->accumulate_points }}<br>
        经验：{{ $user->accumulate_points * 10 }}<br>
        性别：{{ $user->sex}}<br>
        城市：{{ $user->city }}<br>
        工作：{{ $user->job }}<br>
        个性签名：{{ $user->signature }}
    </div>
@endsection