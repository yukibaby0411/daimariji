<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use Naux\Mail\SendCloudTemplate;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    private $email;

    public function show($id)
    {
        $user = User::find($id);
        if (Gate::allows('user_show', $id)) {
            return view('users.show', compact('user'));
        } else {
            return redirect('/404');
        }

    }

    public function edit($id)
    {
        $user = User::find($id);
        if (Gate::allows('user_show', $id)) {
            return view('users.edit', compact('user'));
        } else {
            return redirect('/404');
        }
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        if (!Gate::allows('user_show', $id)) {
            return redirect('/404');
        }

        $this->validate($request, [
            'city' => 'max:64',
            'job' => 'max:64',
        ]);

        $user['city'] = $request->city;
        $user['job'] = $request->job;
        $user['sex'] = $request->sex;
        $user['signature'] = $request->signature;
        $user->save();

        return redirect('/users/'.$id);
    }

    public function set($id)
    {
        $user = User::find($id);
        if (Gate::allows('user_show', $id)) {
            return view('users.set', compact('user'));
        } else {
            return redirect('/404');
        }

    }

    public function give_email() {
        return $this->email;
    }

    public function send_mail($id, $email) {
        //生成令牌
        $token = str_random(16);
        User::where('id', $id)->update(['activation_token' => $token]);

        //发送邮件
        $email = explode('snowday0312', $email);
        $this->email = $email[0];
        $action = $email[1];
        if( ($action != 'bd') && ($action != 'jb') ) {
            return back();
        }

        $bind_data = [
            'url' => 'http://daimariji.app/users/'.$id.'/email/'.$this->email.'/'.$action.'/'.$token,
            'username' => User::find($id)->name,
            'time' => date('Y年m月d日 H:i:s', time()),
        ];

        if($action == 'bd') {
            $bind_data['action'] = '绑定';
        } elseif($action == 'jb') {
            $bind_data['action'] = '换绑';
        }

        $template = new SendCloudTemplate('snowday0312_register', $bind_data);

        try {
             Mail::raw($template, function ($message) {
                $message->from('snowday0312@outlook.com', '代码日记');
                $message->to(\App\Http\Controllers\UsersController::give_email());
            });
        } catch (Exception $e) {
            //异常处理
        }


    }

    //响应绑定、换绑激活链接
    public function get_email($id, $email, $action, $token)
    {
        $user = User::find($id);
        if( $user->activation_token == $token ) {
            $user->email = $email;
            $user->activation_token = NULL;
            $user->save();
        } else {
            echo "<script>alert('请勿提交非法请求！');</script>";
            return back();
        }
        if($action == 'bd') {
            session()->flash('success', '恭喜您，邮箱绑定成功，获得100积分~');
            $user->accumulate_points += 100;
            $user->save();
        } elseif($action == 'jb') {
            session()->flash('success', '恭喜您，邮箱换绑成功~');
        }
        return redirect( '/users/'.$user->id.'/set' );
    }
    /*
        function send_mails() {
            $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';

            $vars = json_encode( array("to" => array('test@ifaxin.com'),
                    "sub" => array("%code%" => Array('123456'))
                )
            );

            $API_USER = '...';
            $API_KEY = '...';
            $param = array(
                'apiUser' => $API_USER, # 使用api_user和api_key进行验证
                'apiKey' => $API_KEY,
                'from' => 'sendcloud@sendcloud.org', # 发信人，用正确邮件地址替代
                'fromName' => 'SendCloud',
                'xsmtpapi' => $vars,
                'templateInvokeName' => 'test12346',
                'subject' => 'Sendcloud php webapi template example',
                'respEmailId' => 'true'
            );

            $data = http_build_query($param);

            $options = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $data
                ));
            $context  = stream_context_create($options);
            $result = file_get_contents($url, FILE_TEXT, $context);

            return $result;
        }

        echo send_mails();
    */
}
