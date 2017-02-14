<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>页面未找到</title>
    <link rel="icon" href="/images/icon.png">
    <link href="./css/404.css" type="text/css" rel="stylesheet">
    <noscript><style>#loading body { opacity: 1; transform: none; }</style></noscript>
</head>

<body class="not-found">
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <div class="ghost">
                <a href="{{ url('/') }}" class="body" target="_blank">
                    <span>
                        <i style="width: 15px; height: 18px; background-color: #616161; border-radius: 50%; margin-right: 5px;"></i>
                        <i style="width: 15px; height: 18px; background-color: #616161; border-radius: 50%; margin-left: 5px;"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-sm-7">
            <h2>页面未找到</h2>
            <p>咦，这是哪里？&nbsp;你好像走丢了...<br />回<a href="{{ url('/') }}">&nbsp;主页&nbsp;</a>看看吧~</p>
        </div>
    </div>
</div>

<script>try{Typekit.load();}catch(e){}</script>
<script src="./js/404.js" type="text/javascript"></script>

</body>
</html>