@extends('layouts.app')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">找回密码</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/tel') }}">
                            {{ csrf_field() }}

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
                                            data: 'tel='+tel+'&text=您正在申请修改密码，验证码为：&action=reset',
                                            dataType: 'text',
                                            success: function(data){
                                                if(data == '发送成功') {
                                                    djs();
                                                    alert(data);
                                                } else if(data == '超额') {
                                                    alert('您今日的短信发送量已达上限，请选择邮件验证方式或者明天再试~');
                                                } else if(data == '未注册') {
                                                    alert('该手机号未注册账号');
                                                }
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
                                    <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required>
                                    <a href="javascript:void(0);" onclick="check_tel();"><input type="button" value="获取验证码" style="position: absolute; right: 20px; top: 7px; border-radius: 4px; border: 0;" id="djs_btn"></a>

                                    @if ($errors->has('code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">新密码</label>

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
                                        确认重置
                                    </button>
                                    <a href="{{ url('/password/reset') }}" style="position: relative; left: 20px; top: 10px;">通过邮箱验证找回？</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
