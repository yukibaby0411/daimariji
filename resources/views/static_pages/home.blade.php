@extends('layouts.app')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')

<div class="container">

    @if (Auth::guest())
        <style>
            .title { display: none;}
            .btn-mid{ font-size: 16px; padding: 8px 13px; border-radius: 4px; line-height: 1.4em;}
        </style>
        <script src="/js/jquery-2.0.3.min.js"></script>
        <script>
            $(document).ready(function () {
                times();
                setTimeout("$('.title1').fadeOut(1000)",950);
                setTimeout("$('.title2').fadeIn(1000)",1950);
                setTimeout("$('.title2').fadeOut(1000)",3700);
                setTimeout("$('.title3').fadeIn(1000)",4700);
                setTimeout("$('.title3').fadeOut(1000)",6450);
                setTimeout("$('.title4').fadeIn(1000)",7450);
                setTimeout("$('.title4').fadeOut(1000)",9200);
                setTimeout("window.location.href='home'",9500);
            });
            function times() {
                second_num = document.getElementById('second_num');
                if(parseInt(second_num.firstChild.nodeValue))
                    second_num.innerHTML = parseInt(second_num.firstChild.nodeValue) - 1;
                setTimeout("times()",1100);
            }
        </script>

        <div class="bs-example" style="text-align: center;">
            <div class="jumbotron" style=" background-color: white;">
                <h1 style="font-size: 36px;">
                    <div style="width: 100%; height: 40px;">
                        <div class="title1">永远相信...</div>
                        <div class="title title2">美好的事情即将发生</div>
                        <div class="title title3">欢迎来到代码日记</div>
                        <div class="title title4">即将开启你的新奇之旅</div>
                    </div>
                </h1>
                <br>
                <p style="font-size: 16px; color: #ff0066;">系统检测到您未登录，请先登录( <span id="second_num">10</span>s )</p>
                <br>
                <p>
                    <a class="btn btn-success btn-mid" href="{{ url('/login') }}" role="button" style="margin-right: 10px;">已有账号，马上登录</a>
                    <a class="btn btn-primary btn-mid" href="{{ url('/register') }}" role="button">注册新账号</a>
                </p>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">您已登录</div>
                    <div class="panel-body" style="text-align: center;">
                        不需要重复登录哦~
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
@endsection
