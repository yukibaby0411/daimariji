<?php

namespace App\Http\Controllers\Ajax;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    public function tel(Request $request) {
        $tel = $request['tel'];

        $if_exist = User::where('tel', $tel)->count();

        if($if_exist) {
            echo '手机号已存在';
            return;
        }
        $code = rand(100000,999999);
        session(['tel_code' => $code]);

        $url = 'http://web.cr6868.com/asmx/smsservice.aspx';
        $name = '18513759449';
        $pwd = 'E37B8C1D1745A0B9110A4A0F8577';
        $content = '欢迎加入代码日记，您的验证码为：'.$code;
        $mobile = $tel;
        $sign = '代码日记';
        $type = 'pt';
        $url = $url . '?name=' . $name . '&pwd=' . $pwd . '&content=' . $content . '&mobile=' . $mobile . '&sign=' . $sign . '&type=' . $type;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        $output = curl_exec($ch);
        $arr = explode(',', $output);
        if($arr[0] === '0'){
            session(['tel_num' => $tel]);
            echo "发送成功";
        } else {
            echo "发送失败";
        }
        curl_close($ch);

        /*
        $url = 'http://sms.253.com/msg/send';
        $un = 'N6161344';
        $pw = 'iPsLzNDpvOa236';
        $phone = $tel;
        $msg = $code;
        $rd = '1';

        $url = $url . '?un=' . $un . '&pw=' . $pw . '&phone=' . $phone . '&msg=' . $msg . '&rd=' . $rd;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        $output = curl_exec($ch);
        if($output === FALSE ){
            echo "发送失败";
        } else {
            session(['tel_num' => $tel]);
            echo "发送成功";
        }
        curl_close($ch);
        */
    }
}
