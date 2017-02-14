<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Naux\Mail\SendCloudTemplate;
use Illuminate\Support\Facades\Mail;

class MailsController extends Controller
{
    private static $email;

    public static function sends($data) {

        self::$email = $data['user']['email'];
        $token = $data['token'];

        $bind_data = [
            'url' => 'http://daimariji.app/password/reset/'.$token,
            'username' => $data['user']['name'],
            'time' => date('Y年m月d日 H:i:s', time()),
        ];

        $template = new SendCloudTemplate('snowday0312_reset', $bind_data);

        try {
            Mail::raw($template, function ($message) {
                $message->from('snowday0312@outlook.com', '代码日记');
                $message->to(self::$email);
            });
        } catch (Exception $e) {
            //异常处理
        }
    }

}
