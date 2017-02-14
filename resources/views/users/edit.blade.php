@extends('layouts.app')

@section('title', '编辑资料')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')
    <div class="container" style="background-color: white; border-radius: 8px; font-size: 17px;">
        <div style="margin: 40px auto; width: 600px; position: relative; left: -50px;">
            <form method="post" action="{{ url('/users/'.$user->id) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            <a href="" style="width: 120px; display: inline-block; float: left; margin-right: 40px;">
                <img src="/images/{{ $user->avatar }}" width="120" height="120">
                <span style="font-size: 15px; margin-left: 14px;">点击上传头像</span>
            </a>

            <div style="float: left;">
                <span style="margin-right: 100px; font-size: 36px;">{{ $user->name }}</span>
                <a href="{{ url('/users/'.$user->id) }}">返回个人中心</a><br><br>

                城&nbsp;&nbsp;&nbsp;市：
                <input type="text" style="width: 100px;" value="{{ $user->city }}" name="city">
                <br><br>

                工&nbsp;&nbsp;&nbsp;作：
                <input type="text" style="width: 100px;" value="{{ $user->job }}" name="job">
                <br><br>

                性&nbsp;&nbsp;&nbsp;别：
                <input type="radio" name="sex" value=1 id="sex_1"
                        @if($user->sex == 1)
                        checked
                        @endif
                >
                <label for="sex_1">男</label>

                <span style="margin-right: 15px;">&nbsp;</span>

                <input type="radio" name="sex" value=2 id="sex_2"
                       @if($user->sex == 2)
                       checked
                       @endif
                >
                <label for="sex_2">女</label>

                <input type="radio" name="sex" value=0 id="sex_0" style="display: none;"
                       @if($user->sex == 0)
                       checked
                       @endif
                >
                <br><br>


                个性签名：
                <textarea style="width: 100%; height: 80px; overflow: hidden;" name="signature">
                    {{ $user->signature }}
                </textarea>
                <br><br>
                <input type="submit" value="确认修改">
            </div>
            <div style="clear: both;"></div>
            </form>
        </div>


    </div>
@endsection