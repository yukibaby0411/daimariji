<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelsController extends Controller
{
    public function reset(Request $request) {
        $this->validate($request, [
            'tel' => [
                'regex:/^'.session()->get('tel_num').'$/',
            ],
            'code' => ['regex:/^'.session()->get('tel_code').'$/'],
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::where('tel', session()->get('tel_num'));
        $result = $user->update(['password' => password_hash($request['password'], PASSWORD_BCRYPT)]);
        if($result) {
            session()->forget('tel_num');
            session()->forget('tel_code');
        }
        session()->flash('success', '恭喜您，密码修改成功~');
        Auth::login($user->first());
        return redirect('/notices');
    }

    public function logout() {
        Auth::logout();
        return redirect('/password/reset');
    }
}
