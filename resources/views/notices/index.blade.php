@extends('layouts.app')

@section('title', '公告')

@section('js_app_promise')
    <script src="/js/app.js"></script>
    <script src="/js/jquery.zclip.min.js"></script>
@endsection

@section('content')
    <script>
        //需要获得公告总数，并给每个text_id和btn_id赋值
        //获取总数暂由js实现
        $(document).ready(function(){
            over_times = document.getElementsByClassName('add_times').length;
        });
        function push_ud(id_num) {
            text_cont = document.getElementById('text'+id_num);
            if(text_cont.style.height) {
                text_cont.style.height= "";
                document.getElementById('btn'+id_num).innerHTML = '折叠';
                over_times--;
            } else {
                text_cont.style.height= "50px";
                document.getElementById('btn'+id_num).innerHTML = '展开';
                over_times++;
            }
            if(over_times == 0) {
                document.getElementById('btn_all').innerHTML = '全部折叠';
            }else if(over_times == document.getElementsByClassName('add_times').length) {
                document.getElementById('btn_all').innerHTML = '全部展开';
            }
        }
        function push_all() {
            times =  document.getElementsByClassName('add_times').length;
            pull_to = document.getElementById('btn_all').firstChild.nodeValue;
            if(pull_to == '全部展开') {
                for(var i = 1; i < times+1; i++) {
                    document.getElementById('text' + i).style.height = "";
                    document.getElementById('btn' + i).innerHTML = '折叠';
                    document.getElementById('btn_all').innerHTML = '全部折叠';
                }
            } else {
                for(var i = 1; i < times+1; i++) {
                    document.getElementById('text' + i).style.height = "50px";
                    document.getElementById('btn' + i).innerHTML = '展开';
                    document.getElementById('btn_all').innerHTML = '全部展开';
                }
            }
        }
        //复制指定内容到剪切板
        $(function(){
            $('#copy_input').zclip({
                path: 'plugins/ZeroClipboard.swf',
                copy: function(){
                    return '120.77.219.5';
                },
                afterCopy: function(){
                    if(!$('#msg').text())
                        $("<span id='msg' style='font-size: 12px;'/>").insertAfter($('#copy_input')).text('复制成功');
                }
            });
        });
        //获取全文搜索框焦点
        function exit_focus() {
            document.getElementById('close_window').click();
            for(var i = 4; i<9; i++) {
                setTimeout("document.getElementById('search_input_focus').focus()", i*100);
            }
        }
    </script>
    <style>
        .duilian{ width: 120px; height: 800px; background-color: white; position: absolute; border: 1px solid #ccc; border-radius: 4px; background-image: url("/images/duilian.jpg"); background-size: 240px 800px; background-position: 120px -10px;}
        .a_normal:link { text-decoration: none;}
        .a_normal:visited { color: #666;}
        .a_normal:hover { text-decoration: none; cursor: text;}
    </style>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="min-height: 823px;">
                <!--对联-->
                <!--天地自成文湖山有美，国家斯得士桃李无言-->
                <div class="duilian" style="background-position: 0 -10px; left: -145px;" ></div>
                <div class="duilian" style="right: -145px;"></div>
                <!--折叠按钮-->
                @include('shared.messages')
                <div class="panel panel-default">
                    <button class="btn btn-default" style="width: 100%;" onclick="push_all();" id="btn_all">全部展开</button>
                </div>
                <!--****公告块****-->

                @if($notices->currentPage()==1)
                <!--****域名域名域名域名****-->
                <div class="panel panel-default add_times">
                    <div class="panel-heading"><span class="label label-info" style="margin-right: 10px; position: relative; top: -2px;">置顶</span>关于本站域名</div>
                    <div class="panel-body" style="text-align: center; position: relative; height: 50px; overflow: hidden;" id="text1">
                        <p>本站域名为：daimariji.com（代码日记），该域名已经成功注册。</p>
                        <p>但由于时间原因，暂未绑定备案。因此暂时只能通过公网ip来访问。</p>
                        <p style="margin-left: -30px;">点击下方复制，将ip地址保存起来吧。</p>
                        <p style="margin-left: -60px;">不便之处，还请大家多多谅解~</p>
                        <p>
                            <input type="text" value="120.77.219.5" style="font-size: 15px; width: 88px; margin-right: 30px;" disabled>
                            <span style="display: inline-block; width: 145px; height: 30px; text-align: left;">
                                <button class="btn btn-primary" style="padding-top: 3px; padding-bottom: 3px; margin-right: 10px; margin-top: -5px;" id="copy_input">点击复制</button>
                            </span>
                        </p>
                        <button class="btn btn-default" style="position: absolute; right: 10px; bottom: 7px;" onclick="push_ud(1);" id="btn1">展开</button>
                    </div>
                </div>

                <!--****功能功能功能功能****-->
                <div class="panel panel-default add_times">
                    <div class="panel-heading"><span class="label label-info" style="margin-right: 10px; position: relative; top: -2px;">置顶</span>关于本站功能</div>
                    <div class="panel-body" style="text-align: center; position: relative; height: 50px; overflow: hidden;" id="text2">
                        {{------------已经开放------------}}
                        {{------------已经开放------------}}
                        {{------------已经开放------------}}
                        {{------------已经开放------------}}
                        <p style=" font-weight: bold;">已经开放的模块（按开放时间顺序）：</p>
                        <p>（点击查看相关介绍）</p>
                        <p>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
                                    <input type="radio" name="options" id="option1" autocomplete="off">公 告
                                </label>
                                <label class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                    <input type="radio" name="options" id="option2" autocomplete="off">寄 语
                                </label>
                                <label class="btn btn-primary" data-toggle="modal" data-target="#myModal3">
                                    <input type="radio" name="options" id="option3" autocomplete="off">个人中心
                                </label>
                                <label class="btn btn-primary" data-toggle="modal" data-target="#myModal4">
                                    <input type="radio" name="options" id="option4" autocomplete="off">系统设置
                                </label>
                            </div>
                        <p>
                        <!--****公告介绍****-->
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">公告简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        公告模块会发布一些关于本站的最新动态。<br>
                                        比如建设进度，注意事项，还包括一些帮助信息。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入公告</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****寄语介绍****-->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">寄语简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        寄语模块包含站长的一段自述，这也是建站的初衷。<br>
                                        计时器从站点建立开始计时，计满十二年为止。<br>
                                        十二年，一个轮回，是梦想从初生到茁壮的约期。<br>
                                        <span style="color: orange;">温馨提示：会默认播放背景音乐，请调节到合适音量。</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入寄语</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****个人中心介绍****-->
                        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">个人中心简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        个人中心模块是用户在该站的信息汇总。<br>
                                        包含个人信息、头像、账户资料、历史记录和一些统计信息。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入个人中心</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****系统设置介绍****-->
                        <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">系统设置简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        系统设置模块方便用户修改该站的相关配置。<br>
                                        主要是账户安全方面的配置，比如：<br>
                                        设置安全邮箱，密保问题，找回密码，更改对外访问权限等。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入系统设置</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{------------计划开放------------}}
                        {{------------计划开放------------}}
                        {{------------计划开放------------}}
                        {{------------计划开放------------}}
                        <p style="font-weight: bold;"><a href="#" name="plan_open" class="a_normal">计划开放</a>的模块（按建设规划顺序）：</p>
                        <p>（点击查看相关介绍）</p>
                        <div class="btn-group" data-toggle="buttons" style="margin-left: 66px;">
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal5">
                                <input type="radio" name="options" id="option1" autocomplete="off">认 证 / 积 分
                            </label>
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal6">
                                <input type="radio" name="options" id="option2" autocomplete="off">反 馈
                            </label>
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal7">
                                <input type="radio" name="options" id="option3" autocomplete="off">消 息
                            </label>
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal8">
                                <input type="radio" name="options" id="option4" autocomplete="off">说 说
                            </label>
                        </div>
                        （第一批）<br><br>
                        <!--****认证/积分介绍****-->
                        <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">认证/积分简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        会员认证：<br>
                                        <p style="text-align: left; margin-left: 80px;">
                                            申请认证并审核通过后，将成为加V会员，用户名后带金色“V”字标识<br>
                                        </p>

                                        积分系统：<br>
                                        <p style="text-align: left; margin-left: 80px;">
                                            1. 每位会员初始积分为100分，系统会根据日常行为偏好相应加分或减分。<br>
                                            2. 积分可以用来在积分商城兑换礼品，兑换成功后积分余额会相应减少。<br>
                                            3. 经验 = 积分*10，根据经验划分会员等级，经验不随积分兑换而减少。<br>
                                        </p>

                                        加分行为：<br>
                                        <p style="text-align: left; margin-left: 80px;">
                                            1. 每天签到加1分，连续签到次数越多，积分奖励越多。<br>
                                            2. <span style="color: red;">通过反馈提交意见或建议并被采纳，可以获得大量积分。</span><br>
                                            3. 每次评论（包括留言，回复等），内容不少于15个字，加1分。<br>
                                            4. 还有一些后续功能，比如休闲小游戏等，参与也会赠送积分。<br>
                                        </p>
                                        减分行为：<br>
                                        <p style="text-align: left; margin-left: 80px;">
                                            1. 做广告宣传，恶意灌水者，每次扣3分。<br>
                                            2. 传播色情、暴力、邪教和其他违法信息的，每次扣5分。<br>
                                            3. 侮辱、谩骂，及其他方式进行人身攻击的，每次删除内容并扣10分。<br>
                                            4. 破坏公共网络环境或试图以任何方式对网站进行恶意攻击的，不通告直接删除会员。
                                        </p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">申请认证</button></a>
                                        <a href=""><button type="button" class="btn btn-primary">我要反馈</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****反馈介绍****-->
                        <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">反馈简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        您可以在反馈模块中提交意见或建议。<br><br>
                                        我们大力鼓励大家积极参与进来。<br>
                                        您对网站现有功能有什么不满，哪些地方需要改进？<br>
                                        除计划开放的功能模块外，您还希望添加什么功能？<br>
                                        您是否发现了错误，或者是bug？<br>
                                        可以畅所欲言，我们会认真对待您提交的反馈信息。<br>
                                        <span style="color: red;">如果您提供了有价值的建议并被采纳，您将获得非常丰厚的积分奖励！</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">我要反馈</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****消息介绍****-->
                        <div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">消息简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        消息系统是用户在该站的通知信息汇总。<br>
                                        包含系统通知、私信和其他一些通知信息和历史记录。<br>
                                        当然，您也可以给其他用户发送私信。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入消息中心</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****说说介绍****-->
                        <div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">说说简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        说说模块是供您分享心情和状态的平台。<br>
                                        您可以把它想象成qq的说说，或者新浪的微博。<br>
                                        支持图片上传，字数无明确限制，但建议别太冗长。<br>
                                        如果想发表文章敬请关注后续开放的博客模块。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">开始说说</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{------------第二批------------}}
                        {{------------第二批------------}}
                        {{------------第二批------------}}
                        {{------------第二批------------}}
                        <div class="btn-group" data-toggle="buttons" style="margin-left: 66px;">
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal9">
                                <input type="radio" name="options" id="option1" autocomplete="off">博&nbsp;&nbsp;客
                            </label>
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal10">
                                <input type="radio" name="options" id="option2" autocomplete="off">答&nbsp;&nbsp;人
                            </label>
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal11">
                                <input type="radio" name="options" id="option3" autocomplete="off">全文搜索
                            </label>
                            <label class="btn btn-primary" data-toggle="modal" data-target="#myModal12">
                                <input type="radio" name="options" id="option4" autocomplete="off">代 码 树
                            </label>
                        </div>
                        （第二批）
                        <!--****博客介绍****-->
                        <div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">博客简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        这是一个中规中矩的博客模块。<br>
                                        你可以发表博客文章，并插入图片。<br>
                                        还可以设置权限：公开，还是仅自己可见。<br>
                                        如果是公开博客，别人可以进行评论。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入博客</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****答人介绍****-->
                        <div class="modal fade" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">答人简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        答人模块是一个问答形式的技术交流平台。<br>
                                        只要是it技术方面的问题，你都可以来这里提问。<br>
                                        也欢迎你回答擅长领域的问题，帮别人答疑解惑。<br>
                                        如果你的答案被采纳，可获得较多积分。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入答人</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****全文搜索介绍****-->
                        <div class="modal fade" id="myModal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">全文搜索简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        全文搜索（检索）模块实现了该站点的全文索引。<br>
                                        你可以通过关键词，快速从站点所有公开数据中获取你想要的资源。<br>
                                        听起来是不是很酷？快来试一试吧 <(￣ˇ￣)/
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="close_window">关闭</button>
                                        <button type="button" class="btn btn-primary" onclick="exit_focus();">开始全文搜索</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--****代码树介绍****-->
                        <div class="modal fade" id="myModal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title" id="myModalLabel">代码树简介</h4>
                                    </div>
                                    <div class="modal-body">
                                        <span style="font-weight: bold;">代码树是代码笔记的核心部分，是重点开发模块</span><br>
                                        主要功能有：
                                        <p style="margin-left: 90px; text-align: left;">
                                            1. 这里有各种规格的开源代码，实例代码；<br>
                                            <span style="color: red;">2. 欢迎上传优秀代码，评优通过可获得大量积分；</span><br>
                                            3. 支持原创，如有转载请注明出处，或者标记“转载”字样；<br>
                                            4. 休闲小游戏，当然代码也是开放的，游戏通关还有积分奖励哦；
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <a href=""><button type="button" class="btn btn-primary">进入代码树</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default" style="position: absolute; right: 10px; bottom: 7px;" onclick="push_ud(2);" id="btn2">展开</button>
                    </div>
                </div>

                <!--****进度进度进度进度****-->
                <div class="panel panel-default add_times">
                    <div class="panel-heading"><span class="label label-info" style="margin-right: 10px; position: relative; top: -2px;">置顶</span>关于建设进度</div>
                    <div class="panel-body" style="position: relative; height: 50px; overflow: hidden;" id="text3">
                        <div style="width: 480px; text-align: justify; margin: 0 auto; line-height: 1.8em; text-indent: 2em;">
                            <p>
                                <a href="">寄语</a>中的计时器从鸡年钟声敲响开始计时。
                            </p>
                            <script>
                                function jump_to_plan() {
                                    if(document.getElementById('btn2').firstChild.nodeValue == '展开') {
                                        document.getElementById('text2').style.height='';
                                        document.getElementById('btn2').innerHTML = '折叠';
                                        over_times--;
                                    }
                                    window.location.href='#plan_open';
                                }
                            </script>
                            <p>此时站点刚刚建立，只有初期会员注册所依赖的几个模块（雏形版）予以开放，但并不完善，也未完成功能性与交互性。<a href="javascript:void(0);" onclick="jump_to_plan();">计划开放</a>的模块也只是提上了日程，还没有着手开发。</p>
                            <p>鉴于该站的开发和维护只能利用少量的闲暇时间，进度可能比较慢，恭请小伙伴们稍安勿躁。当然，如果能受到比较多的人关注，我也会加快开发速度。</p>
                            <p>希望能得到大家的鼓励和支持。</p>
                            <span style=" text-align: right; display: inline-block; width: 100%;">就这样吧~敬礼~</span>
                        </div>
                        <button class="btn btn-default" style="position: absolute; right: 10px; bottom: 7px;" onclick="push_ud(3);" id="btn3">展开</button>
                    </div>
                </div>

                <!--****征集征集征集征集****-->
                <div class="panel panel-default add_times">
                    <div class="panel-heading"><span class="label label-info" style="margin-right: 10px; position: relative; top: -2px;">置顶</span>关于意见征集</div>
                    <div class="panel-body" style="position: relative; height: 50px; overflow: hidden;" id="text4">
                        <div style="width: 480px; text-align: justify; margin: 0 auto; line-height: 1.8em; text-indent: 2em;">
                            <p>一个人的力量是有限的，但很多人的智慧是无限的。</p>
                            <p>非常希望得到大家的帮助，集思广益，为<span style="font-weight: bold;">代码笔记</span>的建设添砖加瓦。大家有什么好的意见或建议热烈欢迎你去<a href="">反馈</a>里提交。<span style="color: red;">如果被采纳，你会得到大量积分。</span>积分可不是摆设哦，可以去<a href="">积分商城</a>兑换礼品的。</p>
                            <p>有什么重要的决策，我也会提前进行意见征集，并发布在<a href="">公告</a>里。欢迎大家踊跃参与~</p>
                        </div>
                        <button class="btn btn-default" style="position: absolute; right: 10px; bottom: 7px;" onclick="push_ud(4);" id="btn4">展开</button>
                    </div>
                </div>
                @endif

                <!--****趣味功能征集****-->
                {{--
                <div class="panel panel-default add_times">
                    <div class="panel-heading"><span class="label label-danger" style="margin-right: 10px; position: relative; top: -2px;">征集</span>趣味功能征集</div>
                    <div class="panel-body" style="position: relative; height: 50px; overflow: hidden;" id="text5">
                        <div style="width: 480px; text-align: justify; margin: 0 auto; line-height: 1.8em; text-indent: 2em;">
                            <p>计划开放一些有趣的功能，暂时拟定的有三项：</p>
                            <p>1. 经验系统（暂行的经验算法为：经验=历史积分*10），通过经验值划分会员等级，比如武侠的“江湖草莽”——“绝世高人”，再如文化程度的“幼儿园大班”——“博士生导师”；</p>
                            <p>2. 投票统计，糗事笑话，智力小测试之类的，这个模块一定会有，只不过具体细节没有想好；</p>
                            <p>3. 类似于支付宝集福或者蚂蚁森林的东东，不过我绝对没有两亿红包给你们发 <=_= ;</p>
                            <p>你有什么好的想法吗？欢迎<a href="">反馈</a>哦~</p>
                        </div>
                        <button class="btn btn-default" style="position: absolute; right: 10px; bottom: 7px;" onclick="push_ud(5);" id="btn5">展开</button>
                    </div>
                </div>
                --}}
                @foreach($notices as $notice)
                <div class="panel panel-default
                     @if($notice->order != 0)
                     add_times
                     @endif
                     "
                     @if($notice->order == 0)
                     style="display: none;"
                     @endif
                >
                    <div class="panel-heading"><span class="label label-{{ $notice->notices_label->style }}" style="margin-right: 10px; position: relative; top: -2px;">{{ $notice->notices_label->word }}</span>{{ $notice->title }}</div>
                    <div class="panel-body" style="position: relative; height: 50px; overflow: hidden;"
                    @if($notice->order != 0)
                    id="text{{ $loop->index+1 }}"
                    @endif
                    >
                        <div style="width: 480px; text-align: justify; margin: 0 auto; line-height: 1.8em; text-indent: 2em;">
                            {!! $notice->content !!}
                            <br>
                        </div>
                        <button class="btn btn-default" style="position: absolute; right: 10px; bottom: 7px;" onclick="push_ud({{ $loop->index+1 }});"
                                @if($notice->order != 0)
                                id="btn{{ $loop->index+1 }}"
                                @endif
                                >展开</button>
                    </div>
                </div>
                @endforeach
                <style>
                    .pagination{ margin-top: 0; margin-bottom: 16px;}
                </style>
                <div style="text-align: center;">
                    {{ $notices->render() }}
                </div>


                <!--****公告块结束****-->

            </div>
        </div>
    </div>
@endsection