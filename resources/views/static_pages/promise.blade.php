@extends('layouts.app')

@section('js_app_promise')
    <script src="/js/app.js"></script>
@endsection

@section('content')
    <script type="text/javascript" src="jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="js/hua_jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/hua_default.css">
    <script type="text/javascript" src="js/hua_jscex.min.js"></script>
    <script type="text/javascript" src="js/hua_jscex-parser.js"></script>
    <script type="text/javascript" src="js/hua_jscex-jit.js"></script>
    <script type="text/javascript" src="js/hua_jscex-builderbase.min.js"></script>
    <script type="text/javascript" src="js/hua_jscex-async.min.js"></script>
    <script type="text/javascript" src="js/hua_jscex-async-powerpack.min.js"></script>
    <script type="text/javascript" src="js/hua_functions.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/hua_love.js" charset="utf-8"></script>
    <audio autoplay="autopaly">
        <source src="/plugins/kisstherain.mp3" type="audio/mp3" />
    </audio>


    <div id="main" style="margin-top: -10px;">
        <div id="error">本页面采用HTML5编辑，目前您的浏览器无法显示，请换成谷歌(<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html?hl=zh-CN&brand=CHMI">Chrome</a>)或者火狐(<a href="http://firefox.com.cn/download/">Firefox</a>)浏览器，或者其他游览器的最新版本。</div>
        <div id="wrap">
            <div id="text">
                <div id="code">
                    <font color="#777777">
                        <span class="say">种一棵树，最好的时间是十年前</span><br>
                        <span class="say">其次是现在</span><br>
                        <span class="say"></span><br>
                        <span class="say">十年前，我们错过了</span><br>
                        <span class="say">那么从现在开始的十分钟内</span><br>
                        <span class="say">我们来准备种一棵参天大树</span><br>
                        <span class="say"></span><br>
                        <span class="say">我给自己定了个远大的目标</span><br>
                        <span class="say">誓要在下个鸡年之前实现</span><br>
                        <span class="say">十二年为期，以此为据，以彼为证</span><br>
                        <span class="say">到时回头看看，定是另一番风景</span><br>
                        <span class="say"></span><br>
                        <span class="say">新的一年，希望大家都能有所进益</span><br>
                        <span class="say">能朝自己的理想迈进一步</span><br>
                        <span class="say">祝愿大家笑口常开 ^0^</span><br>
                        <span class="say"></span><br>
                        <span class="say"></span><br>
                        <span class="say"><span class="space"></span> ~~ By 大鑫 ~~ </span>
                    </font>
                    </p>
                </div>
            </div>
            <div id="clock-box"> <span class="STYLE1"></span><font color="#ff8030">网站已经开始建设：</font>
                <div id="clock"></div>
            </div>
            <canvas id="canvas" width="1100" height="680" style="margin-left: -15px;"></canvas>
        </div>
    </div>
    <script>
        (function (){
            var canvas = $('#canvas');

            if (!canvas[0].getContext) {
                $("#error").show();
                return false;        }

            var width = canvas.width();
            var height = canvas.height();
            canvas.attr("width", width);
            canvas.attr("height", height);
            var opts = {
                seed: {
                    x: width / 2 - 20,
                    color: "rgb(190, 26, 37)",
                    scale: 2
                },
                branch: [
                    [535, 680, 570, 250, 500, 200, 30, 100, [
                        [540, 500, 455, 417, 340, 400, 13, 100, [
                            [450, 435, 434, 430, 394, 395, 2, 40]
                        ]],
                        [550, 445, 600, 356, 680, 345, 12, 100, [
                            [578, 400, 648, 409, 661, 426, 3, 80]
                        ]],
                        [539, 281, 537, 248, 534, 217, 3, 40],
                        [546, 397, 413, 247, 328, 244, 9, 80, [
                            [427, 286, 383, 253, 371, 205, 2, 40],
                            [498, 345, 435, 315, 395, 330, 4, 60]
                        ]],
                        [546, 357, 608, 252, 678, 221, 6, 100, [
                            [590, 293, 646, 277, 648, 271, 2, 80]
                        ]]
                    ]]
                ],
                bloom: {
                    num: 700,
                    width: 1080,
                    height: 650,
                },
                footer: {
                    width: 1200,
                    height: 5,
                    speed: 10,
                }
            }

            var tree = new Tree(canvas[0], width, height, opts);
            var seed = tree.seed;
            var foot = tree.footer;
            var hold = 1;

            /*
             canvas.click(
             function(e) {
             var offset = canvas.offset(), x, y;
             x = e.pageX - offset.left;
             y = e.pageY - offset.top;
             if (seed.hover(x, y)) {
             hold = 0;
             canvas.unbind("click");
             canvas.unbind("mousemove");
             canvas.removeClass('hand');
             }
             }).mousemove(function(e){
             var offset = canvas.offset(), x, y;
             x = e.pageX - offset.left;
             y = e.pageY - offset.top;
             canvas.toggleClass('hand', seed.hover(x, y));
             });
             */

            /* 自定义sleep
             function sleep(numberMillis) {
             var now = new Date();
             var exitTime = now.getTime() + numberMillis;
             while (true) {
             now = new Date();
             if (now.getTime() > exitTime)
             return;
             }
             }
             */

            canvas.click(function () {hold = 0;});  //点击整个canvas即给hold赋值

            var seedAnimate = eval(Jscex.compile("async", function () {
                seed.draw();
                while (hold) {
                    $await(Jscex.Async.sleep(10));
                }
                while (seed.canScale()) {
                    seed.scale(0.95);
                    $await(Jscex.Async.sleep(10));
                }
                while (seed.canMove()) {
                    seed.move(0, 2);
                    foot.draw();
                    $await(Jscex.Async.sleep(10));
                }
            }));

            var growAnimate = eval(Jscex.compile("async", function () {
                do {
                    tree.grow();
                    $await(Jscex.Async.sleep(10));
                } while (tree.canGrow());
            }));

            var flowAnimate = eval(Jscex.compile("async", function () {
                do {
                    tree.flower(2);
                    $await(Jscex.Async.sleep(10));
                } while (tree.canFlower());
            }));

            var moveAnimate = eval(Jscex.compile("async", function () {
                tree.snapshot("p1", 240, 0, 610, 680);
                while (tree.move("p1", 500, 0)) {
                    foot.draw();
                    $await(Jscex.Async.sleep(10));
                }
                foot.draw();
                tree.snapshot("p2", 500, 0, 610, 680);

                // 会有闪烁不得意这样做, (＞﹏＜)
                canvas.parent().css("background", "url(" + tree.toDataURL('image/png') + ")");
                canvas.css("background", "#f5f8fa");
                $await(Jscex.Async.sleep(300));
                canvas.css("background", "none");
            }));

            var jumpAnimate = eval(Jscex.compile("async", function () {
                var ctx = tree.ctx;
                while (true) {
                    tree.ctx.clearRect(0, 0, width, height);
                    tree.jump();
                    foot.draw();
                    $await(Jscex.Async.sleep(25));
                }
            }));

            var textAnimate = eval(Jscex.compile("async", function () {
                var together = new Date();
                together.setFullYear(2017, 0, 28); 		    //时间年月日
                together.setHours(0);						//小时
                together.setMinutes(0);					//分钟
                together.setSeconds(0);					    //秒前一位
                together.setMilliseconds(0);				//秒第二位

                $("#code").show().typewriters();
                $("#clock-box").fadeIn(500);
                while (true) {
                    timeElapse(together);
                    $await(Jscex.Async.sleep(1000));
                }
            }));

            var runAsync = eval(Jscex.compile("async", function () {
                $await(seedAnimate());
                $await(growAnimate());
                $await(flowAnimate());
                $await(moveAnimate());

                textAnimate().start();

                $await(jumpAnimate());
            }));

            runAsync().start();
        })();

        setTimeout("$('#canvas').click()",1000);

    </script>
@endsection