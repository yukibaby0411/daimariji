@extends('layouts.app')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">用户名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                            <label for="tel" class="col-md-4 control-label">手机号</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" value="{{ old('tel') }}" required>

                                @if ($errors->has('tel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <script>
                            function check_tel() {
                                tel = document.getElementById('tel').value;
                                if( tel.match(/^1(3|4|5|7|8)\d{9}$/) != null ) {
                                    $.ajax({
                                        type: 'get',
                                        url: '/ajax/code/tel',
                                        data: 'tel='+tel,
                                        dataType: 'text',
                                        success: function(data){
                                            if(data == '发送成功') {
                                                djs();
                                            }
                                            alert(data);
                                        },
                                        error: function(xhr, type){
                                            alert('系统错误');
                                        }
                                    });
                                } else {
                                    alert('无效的手机号');
                                }
                            }
                            i = 60;
                            function djs() {
                                djs_btn=document.getElementById("djs_btn");
                                djs_btn.disabled = "disabled";
                                djs_btn.value="获取验证码("+i+"秒)";
                                i--;
                                if(i<0) {
                                    i=60;
                                    djs_btn.value="获取验证码";
                                    djs_btn.disabled = "";
                                } else {
                                    setTimeout("djs()",1000);
                                }
                            }
                        </script>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">验证码</label>

                            <div class="col-md-6" style="position: relative;">
                                <input id="code" type="text" class="form-control" name="code" required>
                                <a href="javascript:void(0);" onclick="check_tel();"><input type="button" value="获取验证码" style="position: absolute; right: 20px; top: 7px; border-radius: 4px; border: 0;" id="djs_btn"></a>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
