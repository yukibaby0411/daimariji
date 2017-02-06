<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YumingController extends Controller
{
    public function index()
    {
        //暂无法采集域名注册实时信息，通过查询域名信息的缓存代替，需破解验证码

        $com = '01base';
        $url = 'https://whois.aliyun.com/whois/domain/'. $com .'?spm=5176.8076989.339865.10.c1xK9h&file='. $com;

        $opts = [
            'http'=>[
                'method'=>"GET",
                'timeout'=>60,
            ]
        ];

        $context = stream_context_create($opts);

        $html =file_get_contents($url, false, $context);

        $open = fopen('abc.html','w');
        fwrite($open, $html);
        fclose($open);
        return view('yuming/index');
    }
}
