<?php

namespace App\Http\Controllers\Ajax;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    public function tel(Request $request) {
        if(!isset($_COOKIE['message_num'])) {
            setCookie('message_num', 1, time()+600);
        } else {
            setCookie('message_num', $_COOKIE['message_num']+1 ,time()+600);
            if($_COOKIE['message_num']>6) {
                session()->flash('danger', '您发送短信频率过快，请十分钟后再试');
                return redirect('/login');
            }
        }
        $tel = $request['tel'];
        $text = $request['text'] ? : '欢迎加入代码日记，您的验证码为：';
        $action = $request['action'] ? : 'other';

        $if_exist = User::where('tel', $tel)->count();

        if($if_exist) {
            if($action == 'reset') {
                $request['id'] = User::where('tel', $tel)->value('id');
            } else {
                echo '手机号已存在';
                return;
            }
        } else {
            if($action === 'reset') {
                echo '未注册';
                return;
            }
        }

        if( isset($request['id']) ) {
            $id = $request['id'];
            $time = date('ymd', time());
            $user = User::find($id);

            $activations = $user->activations;
            $act_str = (string)$activations;
            $time_str = substr($act_str, 0, -2);
            $num_str = substr($act_str, 6, 8);
            if($time_str == $time) {
                $num_int = (integer)$num_str;
                if( $num_int > 20) {
                    echo '超额';
                    return;
                } else {
                    $num_int ++;
                    $num_str = (string)$num_int;
                    if($num_int<10) {
                        $num_str = '0' . $num_str;
                    }
                }
                $user->activations = $time . $num_str;
            } else {
                $user->activations = $time . '01';
            }

            $user->save();
        }

        $code = rand(100000,999999);
        session(['tel_code' => $code]);

        $url = 'http://web.cr6868.com/asmx/smsservice.aspx';
        $name = '18513759449';
        $pwd = 'E37B8C1D1745A0B9110A4A0F8577';
        $content = $text . $code;
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

    public function email(Request $request) {

        if(!isset($_COOKIE['email_num'])) {
            setCookie('email_num', 1, time()+60);
        } else {
            setCookie('message_num', $_COOKIE['message_num']+1 ,time()+60);
            if($_COOKIE['message_num']>10) {
                session()->flash('danger', '您发送邮件频率过快，请稍后再试');
                return redirect('/login');
            }
        }

        $email = $request['email'];

        //检查如果是url，curl请求
        if(preg_match('/^[http]+/', $email)) {
            $url = $email;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_HEADER,0);
            curl_exec($ch);

        } else {
            //检查邮箱是否重复
            $if_exist = User::where('email', $email)->count();

            if($if_exist) {
                echo '该邮箱已存在';
                return;
            }
        }
    }
}
