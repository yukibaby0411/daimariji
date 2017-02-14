
@extends('layouts.app')

@section('title', '系统设置')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')
    <div class="container" style="background-color: white; border-radius: 8px; font-size: 17px; padding-top: 15px;">
        @include('shared.messages')
        <div style="margin: 40px auto; width: 750px; position: relative; left: -50px;">
            <img src="/images/{{ $user->avatar }}" width="120" height="120" style="border-radius: 50%; float: left; margin-right: 40px;">
            <div style="float: left;">
                <span style="margin-right: 90px; font-size: 36px;">{{ $user->name }}</span>
                <a href="{{ url('/users/'.$user->id) }}" style="margin-right: 20px;">返回个人中心</a><br><br>

                手机号&nbsp;：&nbsp;{{ $user->tel }}&nbsp;
                <script>
                    function check_tel() {
                        tel = document.getElementById('tel').value;

                        if(tel.match(/^1(3|4|5|7|8)\d{9}$/) !== null) {
                           $.ajax({

                                type: 'get',
                                url: '/ajax/code/tel',
                                data: 'tel='+tel+'&text=您正在更换绑定手机，验证码为：&id={{ $user->id }}',
                                dataType: 'text',
                                success: function(data){
                                    if(data === '手机号已存在') {
                                        alert(data);
                                    } else if(data === '发送成功') {
                                        window.location.href = "{{ url('/sessions/users-'.$user->id.'-set/success/验证码发送成功，请注意查收') }}";
                                    } else if(data === '超额') {
                                        alert('今天发送短信数量过多，请明天再试');
                                    }else {
                                        alert('发送失败');
                                    }
                                },
                                error: function(){
                                    alert('系统错误001');
                                }
                            });
                        } else {
                            alert('不是合法的手机号');
                        }
                    }

                </script>

                <span style="font-size: 15px;"><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal2">（换绑手机）</a></span>

                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                <h4 class="modal-title" id="myModalLabel">验证手机</h4>
                            </div>
                            <div class="modal-body" style="padding:22px;">
                                <span style="margin-left: 75px;">手机号：</span>
                                <input type="text" style="width: 200px;" value="" id="tel">
                                <a href="javascript:void(0);" class="btn btn-primary" onclick="check_tel();">
                                    点击发送验证码
                                </a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="close_window">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>

                邮&nbsp;&nbsp;&nbsp;箱&nbsp;：&nbsp;
                <script>
                    function check_email(bangdingOrJiebang) {
                        email = document.getElementById('email').value;
                        if(email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/) !== null) {
                            $.ajax({
                                type: 'get',
                                url: '/ajax/code/email',
                                data: 'email='+email,
                                dataType: 'text',
                                success: function(data){
                                    if(data === '该邮箱已存在') {
                                        alert(data);
                                    } else {
                                        send_email(bangdingOrJiebang);
                                    }
                                },
                                error: function(){
                                    alert('系统错误001');
                                }
                            });
                        } else {
                            alert('不是合法的邮箱');
                        }
                    }

                    function send_email(ifbangding) {
                        $.ajax({
                            type: 'get',
                            url: '/ajax/code/email',
                            data: 'email={{ url("/users/".$user->id."/email") }}/'+email+'snowday0312'+ifbangding,
                            dataType: 'text',
                            success: function(data){
                                window.location.href = "{{ url('/sessions/users-'.$user->id.'-set/success/邮件发送成功，请注意查收') }}";
                            },
                            error: function(){
                                alert('系统错误002');
                            }
                        });
                    }
                </script>
                @if($user->email != NULL)
                    {{ $user->email }}&nbsp;
                    <span style="font-size: 15px;"><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1">（换绑邮箱）</a></span><br><br>

                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                    <h4 class="modal-title" id="myModalLabel">验证邮箱</h4>
                                </div>
                                <div class="modal-body" style="padding:22px;">
                                    <span style="margin-left: 10px;">邮箱地址：</span>
                                    <input type="text" style="width: 300px;" value="" id="email">
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="check_email('jb');" id="mail_action">
                                        点击发送验证邮件
                                    </a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close_window">关闭</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    未绑定&nbsp;
                    <span style="font-size: 15px;">(绑定邮箱可以提高账号安全级别，还可以获得100积分，<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1">立即绑定？</a>)</span><br><br>

                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                    <h4 class="modal-title" id="myModalLabel">验证邮箱</h4>
                                </div>
                                <div class="modal-body" style="padding:22px;">
                                    <span style="margin-left: 10px;">邮箱地址：</span>
                                    <input type="text" style="width: 300px;" value="" id="email">
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="check_email('bd');" id="mail_action">
                                            点击发送验证邮件
                                    </a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close_window">关闭</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <script>
                    function show_safe() {
                        safely = document.getElementById('safely');
                        document.getElementById('safe_btn').style.display = 'none';
                        document.getElementById('safe_case').style.display = 'block';
                        safe_score = {{ceil($user->pass_strong/100*30)}}+{{( (int)($user->email != "") )*20}}+30;
                        if(safe_score<34) {
                            document.getElementById('safe_lv').innerHTML = '低';
                        } else if(safe_score>66) {
                            document.getElementById('safe_lv').innerHTML = '高';
                        }
                        safe_i = 0;
                        get_safely();
                    }
                    function get_safely() {
                        if(safe_i<safe_score) {
                            safe_i++;
                            document.getElementById('safely').style.width = safe_i+'%';
                            switch (safe_i) {
                                case 34:
                                    safely.className = "progress-bar progress-bar-warning progress-bar-striped active";
                                    safe_color = 'warning';
                                break;
                                case 50:
                                    safely.className = "progress-bar progress-bar-info progress-bar-striped active";
                                    safe_color = 'info';
                                break;
                                case 66:
                                    safely.className = "progress-bar progress-bar-success progress-bar-striped active";
                                    safe_color = 'success';
                                break;
                                default:
                                    safe_color = 'success';
                            }

                            setTimeout('get_safely()', 50);
                        } else {
                            safely.className = "progress-bar progress-bar-"+safe_color;
                            safely.innerHTML = safe_score+'分';
                            document.getElementById('display2').style.display = 'inline-block';
                        }

                    }
                </script>

                密&nbsp;&nbsp;&nbsp;码&nbsp;：&nbsp;可用
                <a href="{{ url('/password/tel') }}" style="font-size: 15px;" onclick="return confirm('退出后才能修改密码，确认退出？');">（修改密码）</a> <br><br>
                <div  id="safe_btn" style="display: block;">
                    安全级别：<input type="button" class="btn btn-info" value="开始评测" onclick="show_safe();">
                </div>
                <div id="safe_case" style="display: none;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="safely">
                            <span class="sr-only">45% Complete</span>
                        </div>
                    </div>
                    <i id="display2" style="display: none;">
                        安全评级：<span id="safe_lv">中</span>&nbsp;<a href="javascript:void(0);" style="font-size: 14px;" data-toggle="modal" data-target="#myModal3">（如何提高安全评分）</a><br><br>
                        密码评分：{{ ceil($user->pass_strong/100*30) }}/30<br><br>
                        密保手机：30/30<br><br>
                        密保邮箱：{{ ( (int)($user->email != "") )*20 }}/20<br><br>
                        密保问题：0/20
                    </i>

                </div>

                <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                <h4 class="modal-title" id="myModalLabel">安全指南</h4>
                            </div>
                            <div class="modal-body" style="padding:22px;">
                                <p>
                                    1、提高密码强度（尽量含有数字，字母大小写，符号等多种组合）；<br>
                                    2、保证密保手机安全有效；<br>
                                    3、绑定密保邮箱；<br>
                                    4、（密保问题暂未开放，敬请期待）
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="close_window">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div style="clear: both;"></div>
        </div>

    </div>
@endsection